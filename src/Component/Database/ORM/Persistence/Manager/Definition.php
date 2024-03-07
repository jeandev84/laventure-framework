<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Config\Configuration;
use Laventure\Component\Database\ORM\Persistence\Manager\Event\DefaultEventManager;
use Laventure\Component\Database\ORM\Persistence\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory\ClassMetadataFactory;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\Factory\EntityRepositoryFactory;
use Laventure\Component\Database\ORM\Persistence\Repository\Factory\EntityRepositoryFactoryInterface;
use Laventure\Component\Database\ORM\UnitOfWork\Factory\UnitOfWorkFactory;
use Laventure\Component\Database\ORM\UnitOfWork\Factory\UnitOfWorkFactoryInterface;

/**
 * Definition
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Manager
 */
class Definition extends Configuration
{


    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;



    /**
     * @var UnitOfWorkFactoryInterface
    */
    protected UnitOfWorkFactoryInterface $unitOfWorkFactory;



    /**
     * @var ClassMetadataFactoryInterface
    */
    protected ClassMetadataFactoryInterface $metadataFactory;





    /**
     * @var EntityRepositoryFactoryInterface
    */
    protected EntityRepositoryFactoryInterface $repositoryFactory;





    /**
     * @var EventManagerInterface
    */
    protected EventManagerInterface $eventManager;






    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
         $this->connection        = $connection;
         $this->metadataFactory   = new ClassMetadataFactory();
         $this->unitOfWorkFactory = new UnitOfWorkFactory();
         $this->eventManager      = new DefaultEventManager();
         $this->repositoryFactory = new EntityRepositoryFactory();
    }




    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }





    /**
     * @param UnitOfWorkFactoryInterface $unitOfWorkFactory
     * @return $this
    */
    public function withUnitOfWorkFactory(UnitOfWorkFactoryInterface $unitOfWorkFactory): static
    {
        $this->unitOfWorkFactory = $unitOfWorkFactory;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getUnitOfWorkFactory(): UnitOfWorkFactoryInterface
    {
        return $this->unitOfWorkFactory;
    }







    /**
     * @param EventManagerInterface $eventManager
     * @return $this
    */
    public function withEventManager(EventManagerInterface $eventManager): static
    {
        $this->eventManager = $eventManager;

        return $this;
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
    public function getClassMetadataFactory(): ClassMetadataFactoryInterface
    {
         return $this->metadataFactory;
    }









    /**
     * @inheritDoc
    */
    public function getRepositoryFactory(): EntityRepositoryFactoryInterface
    {
         return $this->repositoryFactory;
    }
}