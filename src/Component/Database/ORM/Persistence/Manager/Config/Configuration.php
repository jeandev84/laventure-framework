<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager\Config;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Service\ReflectionServiceInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\Factory\EntityRepositoryFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\UnitOfWork\Factory\UnitOfWorkFactoryInterface;

/**
 * Configuration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\DataMapper\Manager\Common
*/
abstract class Configuration
{
    /**
     * Returns connection
     *
     * @return ConnectionInterface
    */
    abstract public function getConnection(): ConnectionInterface;





    /**
     * @return UnitOfWorkFactoryInterface
    */
    abstract public function getUnitOfWorkFactory(): UnitOfWorkFactoryInterface;








    /**
     * Returns entity event manager
     *
     * @return EventManagerInterface
    */
    abstract public function getEventManager(): EventManagerInterface;








    /**
     * Returns class metadata factory
     *
     * @return ClassMetadataFactoryInterface
    */
    abstract public function getClassMetadataFactory(): ClassMetadataFactoryInterface;








    /**
     * Returns class repository factory
     *
     * @return EntityRepositoryFactoryInterface
    */
    abstract public function getRepositoryFactory(): EntityRepositoryFactoryInterface;







    /**
     * Returns reflection service
     *
     * @return ReflectionServiceInterface
    */
    abstract public function getReflectionService(): ReflectionServiceInterface;
}
