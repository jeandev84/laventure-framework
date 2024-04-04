<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Transaction\Contract\TransactionInterface;
use Laventure\Component\Database\ORM\Manager\Config\Configuration;
use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Manager\Events\PreFlushEvent;
use Laventure\Component\Database\ORM\Manager\Exception\EntityManagerException;
use Laventure\Component\Database\ORM\Manager\Query\QueryBuilder;
use Laventure\Component\Database\ORM\Manager\Repository\EntityRepository;
use Laventure\Component\Database\ORM\Mapping\ClassMetadata;
use Laventure\Component\Database\ORM\Mapping\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Mapping\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Repository\Contract\EntityRepositoryInterface;
use Laventure\Component\Database\ORM\Repository\Contract\ObjectRepositoryInterface;
use Laventure\Component\Database\ORM\Repository\Factory\EntityRepositoryFactoryInterface;
use Laventure\Component\Database\ORM\UnitOfWork\UnitOfWorkInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use ReflectionException;
use Throwable;

/**
 * EntityManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager
*/
class EntityManager implements EntityManagerInterface
{
    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;



    /**
     * @var Configuration
    */
    protected Configuration $config;





    /**
     * @var EventManagerInterface
    */
    protected EventManagerInterface $eventManager;





    /**
     * @var UnitOfWorkInterface
    */
    protected UnitOfWorkInterface $unitOfWork;





    /**
     * @var ClassMetadataFactoryInterface
    */
    protected ClassMetadataFactoryInterface $metadataFactory;





    /**
     * @var TransactionInterface
    */
    protected TransactionInterface $transaction;




    /**
     * @var ObjectRepositoryInterface[]
    */
    protected array $repositories = [];




    /**
     * @var object[]
    */
    protected array $initialized = [];




    /**
     * @var bool
    */
    protected bool $enabled = true;





    /**
     * @param Configuration $config
    */
    public function __construct(Configuration $config)
    {
        $this->config            = $config;
        $this->connection        = $config->getConnection();
        $this->eventManager      = $config->getEventManager();
        $this->metadataFactory   = $config->getClassMetadataFactory();
        $this->unitOfWork        = $config->getUnitOfWorkFactory()->createUnitOfWork($this);
        $this->transaction       = $this->connection->transaction();
    }




    /**
     * @inheritDoc
    */
    public function isOpen(): bool
    {
        return $this->enabled;
    }




    /**
     * @inheritDoc
    */
    public function resetManager(): static
    {
        $this->enabled = true;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getConfiguration(): Configuration
    {
        return $this->config;
    }





    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }





    /**
     * @inheritDoc
    */
    public function getUnitOfWork(): UnitOfWorkInterface
    {
        return $this->unitOfWork;
    }




    /**
     * @inheritDoc
    */
    public function getEventManager(): EventManagerInterface
    {
        return $this->eventManager;
    }




    /**
     * @inheritDoc
    */
    public function getRepositories(): array
    {
        return $this->repositories;
    }



    /**
     * @inheritDoc
    */
    public function getEntities(): array
    {
        return array_keys($this->repositories);
    }




    /**
     * @inheritDoc
    */
    public function addRepositories(array $repositories): static
    {
        foreach ($repositories as $repository) {
            $this->addRepository($repository);
        }

        return $this;
    }








    /**
     * Add repository
     *
     * @param EntityRepositoryInterface $repository
     * @return $this
    */
    public function addRepository(EntityRepositoryInterface $repository): static
    {
        $this->repositories[$repository->getClassName()] = $repository;

        return $this;
    }






    /**
     * Determine if given class name has repository
     *
     * @param string $classname
     * @return bool
    */
    public function hasRepository(string $classname): bool
    {
        return isset($this->repositories[$classname]);
    }





    /**
     * @inheritDoc
    */
    public function getRepository(string $entity): ObjectRepositoryInterface
    {
        if ($this->hasRepository($entity)) {
            return $this->repositories[$entity];
        }

        $repository = new EntityRepository($this, $this->getClassMetadata($entity));

        return $this->repositories[$entity] = $repository;
    }






    /**
     * @inheritDoc
    */
    public function getClassMetadata($entity): ClassMetadataInterface
    {
        return $this->metadataFactory->getMetadataFor($entity);
    }





    /**
     * @inheritDoc
    */
    public function getMetadataFactory(): ClassMetadataFactoryInterface
    {
        return $this->metadataFactory;
    }








    /**
     * @inheritDoc
    */
    public function beginTransaction(): bool
    {
        return $this->transaction->begin();
    }






    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        return $this->transaction->commit();
    }






    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
        return $this->transaction->rollback();
    }







    /**
     * @inheritDoc
    */
    public function transaction(callable $func): bool
    {
        try {
            $this->beginTransaction();
            $func($this);
            return $this->commit();
        } catch (Throwable $e) {
            $this->rollback();
            $this->close();
            // TODO log error using Connection
            dump($e->getMessage());
            dd(__METHOD__);
        }
    }






    /**
     *  Example: $em->find(User::class, 1)
     *
     * @inheritDoc
    */
    public function find(string $classname, $id): mixed
    {
        return $this->unitOfWork->find($classname, $id);
    }








    /**
     * @inheritDoc
    */
    public function persist(object $object): void
    {
        $this->abortIfClosed($object);

        $this->unitOfWork->persist($object);
    }




    /**
     * @inheritDoc
    */
    public function remove(object $object): void
    {
        $this->abortIfClosed($object);

        $this->unitOfWork->remove($object);
    }





    /**
     * @inheritDoc
     * @throws EntityManagerException
    */
    public function contains(object $object): bool
    {
        $this->abortIfClosed($object);

        return $this->unitOfWork->contains($object);
    }





    /**
     * @inheritDoc
     * @throws EntityManagerException
    */
    public function detach(object $object): void
    {
        $this->abortIfClosed($object);

        $this->unitOfWork->detach($object);
    }




    /**
     * @inheritDoc
     * @throws EntityManagerException
    */
    public function refresh(object $object): object
    {
        $this->abortIfClosed($object);

        return $this->unitOfWork->refresh($object);
    }




    /**
     * @inheritDoc
     * @param object $object
     * @return object
     * @throws EntityManagerException
     * @throws ReflectionException
    */
    public function initializeObject(object $object): object
    {
        $class = ClassMetadata::create($object);
        $id    = $class->getId();

        if (!$this->contains($object)) {
            $this->persist($object);
            $this->initialized[$class->getName()][$id] = $object;
        }

        return $this;
    }




    /**
     * @inheritDoc
     * @throws ReflectionException
     * @throws EntityManagerException
    */
    public function initializedObject(object $object): bool
    {
        $class = ClassMetadata::create($object);
        $name  = $class->getName();
        $id    = $class->getId();
        $initialized = isset($this->initialized[$name][$id]);

        return $this->contains($object) && $initialized;
    }




    /**
     * @inheritDoc
    */
    public function flush(): void
    {
        if ($this->isOpen()) {
            $this->eventManager->dispatchEvent(new PreFlushEvent($this));
            $this->unitOfWork->commit();
        }
    }





    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->unitOfWork->clear();
        $this->initialized = [];
    }





    /**
     * @param string $sql
     * @param array $parameters
     * @return QueryInterface
    */
    public function createNativeQuery(string $sql, array $parameters = []): QueryInterface
    {
        return $this->getConnection()->statement($sql)->setParameters($parameters);
    }






    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return new QueryBuilder($this);
    }






    /**
     * @inheritDoc
    */
    public function close(): void
    {
        if ($this->isOpen()) {
            $this->enabled = false;
        }
    }





    /**
     * Stop propagation if closed manager
     *
     * @param object $object |null $object $object
     * @return void
     * @throws EntityManagerException
    */
    private function abortIfClosed(object $object): void
    {
        if (!$this->enabled) {
            throw new EntityManagerException("Entity manager closed.");
        }
    }
}
