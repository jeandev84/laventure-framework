<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Config\Configuration;
use Laventure\Component\Database\ORM\Persistence\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\Factory\ObjectRepositoryFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\ObjectRepositoryInterface;
use Laventure\Component\Database\ORM\UnitOfWork\UnitOfWorkInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

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
    protected bool $enabled = false;





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
    public function getRepository(string $classname): ObjectRepositoryInterface
    {
        return $this->repositoryFactory->createRepository($classname);
    }






    /**
     * @inheritDoc
    */
    public function getClassMetadata(string $classname): ClassMetadataInterface
    {
        return $this->getMetadataFactory()->getMetadataFor($classname);
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
    public function resetManager(): static
    {
        $this->enabled = true;

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function beginTransaction(): bool
    {
        return $this->connection->beginTransaction();
    }




    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        return $this->connection->commit();
    }




    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
         return $this->connection->rollback();
    }



    /**
     * @inheritDoc
    */
    public function transaction(callable $func): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function createNativeQueryBuilder(): SQLQueryBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function createNativeQuery(string $sql, array $params = []): QueryInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {

    }






    /**
     * @inheritDoc
    */
    public function initializeObject(object $object): mixed
    {

    }





    /**
     * @inheritDoc
    */
    public function find(string $classname, $id): ?object
    {

    }





    /**
     * @inheritDoc
    */
    public function persist(object $object): void
    {

    }





    /**
     * @inheritDoc
    */
    public function remove(object $object): void
    {

    }





    /**
     * @inheritDoc
    */
    public function contains(object $object): bool
    {

    }





    /**
     * @inheritDoc
    */
    public function detach(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function refresh(object $object): void
    {

    }





    /**
     * @inheritDoc
    */
    public function flush(): void
    {

    }





    /**
     * @inheritDoc
    */
    public function clear(): void
    {

    }






    /**
     * @inheritDoc
    */
    public function close(): void
    {
        $this->enabled = false;
    }
}
