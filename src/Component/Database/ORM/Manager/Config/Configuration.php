<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Config;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Mapping\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Mapping\Service\ReflectionServiceInterface;
use Laventure\Component\Database\ORM\Repository\Factory\EntityRepositoryFactoryInterface;
use Laventure\Component\Database\ORM\UnitOfWork\Factory\UnitOfWorkFactoryInterface;

/**
 * Configuration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager\Common
*/
interface Configuration
{
    /**
     * Returns connection
     *
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;





    /**
     * @return UnitOfWorkFactoryInterface
    */
    public function getUnitOfWorkFactory(): UnitOfWorkFactoryInterface;








    /**
     * Returns entity event manager
     *
     * @return EventManagerInterface
    */
    public function getEventManager(): EventManagerInterface;








    /**
     * Returns class metadata factory
     *
     * @return ClassMetadataFactoryInterface
    */
    public function getClassMetadataFactory(): ClassMetadataFactoryInterface;






    /**
     * Returns reflection service
     *
     * @return ReflectionServiceInterface
    */
    public function getReflectionService(): ReflectionServiceInterface;
}
