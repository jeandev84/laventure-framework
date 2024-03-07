<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Config\Configuration;
use Laventure\Component\Database\ORM\Persistence\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Exception\EntityManagerException;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\QueryBuilder;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\Factory\ObjectRepositoryFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\ObjectRepositoryInterface;
use Laventure\Component\Database\ORM\UnitOfWork\UnitOfWorkInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Throwable;

/**
 * EntityManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Manager
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
     * @var ObjectRepositoryFactoryInterface
    */
    protected ObjectRepositoryFactoryInterface $repositoryFactory;






    /**
     * @var ObjectRepositoryInterface[]
    */
    protected array $repositories = [];




    /**
     * @var object[]
    */
    protected array $initialized = [];




    /**
     * @var object[]
    */
    protected array $managed = [];






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
        $this->repositoryFactory = $config->getRepositoryFactory();
        $this->unitOfWork        = $config->getUnitOfWorkFactory()->createUnitOfWork($this);
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
        $this->abortIfIsClosed();

        return $this->config;
    }





    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        $this->abortIfIsClosed();

        return $this->connection;
    }





    /**
     * @inheritDoc
    */
    public function getUnitOfWork(): UnitOfWorkInterface
    {
        $this->abortIfIsClosed();

        return $this->unitOfWork;
    }




    /**
     * @inheritDoc
    */
    public function getEventManager(): EventManagerInterface
    {
        $this->abortIfIsClosed();

        return $this->eventManager;
    }






    /**
     * Add repositories
     *
     * @param array $repositories
     * @return $this
    */
    public function addRepositories(array $repositories): static
    {
       foreach ($repositories as $repository){
           $this->addRepository($repository);
       }

       return $this;
    }





    /**
     * Add repository
     *
     * @param ObjectRepositoryInterface $repository
     * @return $this
    */
    public function addRepository(ObjectRepositoryInterface $repository): static
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
        $this->abortIfIsClosed();

        if ($this->hasRepository($entity)) {
            return $this->repositories[$entity];
        }

        if (!$repository = $this->repositoryFactory->createRepository($entity)) {
            $repository = $this->repositoryFactory->createDefaultRepository($this, $entity);
        }

        return $this->repositories[$entity] = $repository;
    }






    /**
     * @inheritDoc
    */
    public function getClassMetadata(string $entity): ClassMetadataInterface
    {
        $this->abortIfIsClosed();

        return $this->getMetadataFactory()->getMetadataFor($entity);
    }





    /**
     * @inheritDoc
    */
    public function getMetadataFactory(): ClassMetadataFactoryInterface
    {
        $this->abortIfIsClosed();

        return $this->metadataFactory;
    }





    /**
     * @inheritDoc
    */
    public function createNativeQueryBuilder(): SQLQueryBuilderInterface
    {
        $this->abortIfIsClosed();

        return $this->connection->createQueryBuilder();
    }





    /**
     * @inheritDoc
    */
    public function createNativeQuery(string $sql, array $params = []): QueryInterface
    {
        $this->abortIfIsClosed();

        return $this->connection->statement($sql)->setParameters($params);
    }






    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {
        $this->abortIfIsClosed();

        return new QueryBuilder($this);
    }










    /**
     * @inheritDoc
    */
    public function beginTransaction(): bool
    {
        $this->abortIfIsClosed();

        return $this->connection->beginTransaction();
    }






    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        $this->abortIfIsClosed();

        return $this->connection->commit();
    }






    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
        $this->abortIfIsClosed();

        return $this->connection->rollback();
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
            throw new EntityManagerException($e->getMessage());
        }
    }







    /**
     * @inheritDoc
    */
    public function initializeObject(object $object): static
    {
        $this->abortIfIsClosed($object);

        $this->initialized[] = $object;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function find(string $classname, $id): ?object
    {
        return $this->getRepository($classname)->find($id);
    }






    /**
     * @inheritDoc
    */
    public function persist(object $object): void
    {
        $this->abortIfIsClosed($object);

        $this->unitOfWork->persist($object);
    }





    /**
     * @inheritDoc
    */
    public function remove(object $object): void
    {
        $this->abortIfIsClosed($object);

        $this->unitOfWork->remove($object);
    }





    /**
     * @inheritDoc
    */
    public function contains(object $object): bool
    {
        $this->abortIfIsClosed($object);

        return $this->unitOfWork->contains($object);
    }





    /**
     * @inheritDoc
    */
    public function detach(object $object): void
    {
        $this->abortIfIsClosed($object);

        $this->unitOfWork->detach($object);
    }






    /**
     * @inheritDoc
    */
    public function refresh(object $object): void
    {
        $this->abortIfIsClosed($object);

        $this->unitOfWork->refresh($object);
    }





    /**
     * @inheritDoc
    */
    public function flush(): void
    {
        if ($this->isOpen()) {
            $this->unitOfWork->commit();
        }
    }





    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->unitOfWork->clear();
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
     * @param object|null $object $object
     * @return void
     * @throws EntityManagerException
    */
    private function abortIfIsClosed(object $object = null): void
    {
        if (!$this->enabled) {
            throw new EntityManagerException("Entity manager closed");
        }
    }
}
