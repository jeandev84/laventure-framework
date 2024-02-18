<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager;

use Laventure\Component\Database\Connection\ConnectionStackInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;

/**
 * DatabaseManagerFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager
*/
class DatabaseManagerFactory implements DatabaseManagerFactoryInterface
{
    /**
     * @param ConnectionStackInterface $connectionStack
    */
    public function __construct(
        protected ConnectionStackInterface $connectionStack
    ) {
    }



    /**
     * @inheritDoc
    */
    public function createDatabaseManager(array $connections = []): DatabaseManagerInterface
    {
        return new DatabaseManager($this->connectionStack->getConnections());
    }
}
