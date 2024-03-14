<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager\Factory;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Config\Configuration;
use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Definition;
use Laventure\Component\Database\ORM\Persistence\Manager\EntityManager;

/**
 * EntityManagerFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Manager\Factory
*/
class EntityManagerFactory implements EntityManagerFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createEntityManager(Configuration $config): EntityManagerInterface
    {
        return new EntityManager($config);
    }





    /**
     * @param ConnectionInterface $connection
     * @return EntityManagerInterface
    */
    public function createFromConnection(ConnectionInterface $connection): EntityManagerInterface
    {
        return $this->createEntityManager(new Definition($connection));
    }
}
