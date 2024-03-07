<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Config\Configuration;
use Laventure\Component\Database\ORM\Persistence\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\Factory\ObjectRepositoryFactoryInterface;
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
     * @var ClassMetadataFactoryInterface
    */
    protected ClassMetadataFactoryInterface $metadataFactory;





    /**
     * @var ObjectRepositoryFactoryInterface
    */
    protected ObjectRepositoryFactoryInterface $repositoryFactory;





    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(protected  ConnectionInterface $connection)
    {

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
    public function getUnitOfWorkFactory(): UnitOfWorkFactoryInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function getEventManager(): EventManagerInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function getClassMetadataFactory(): ClassMetadataFactoryInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function getRepositoryFactory(): ObjectRepositoryFactoryInterface
    {

    }
}