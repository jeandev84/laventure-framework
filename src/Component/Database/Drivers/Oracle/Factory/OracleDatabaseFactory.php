<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Oracle\Factory;

use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Drivers\Oracle\Connection\OracleConnection;
use Laventure\Component\Database\Drivers\Oracle\OracleDatabase;
use Laventure\Component\Database\Factory\DatabaseFactory;

/**
 * OracleDatabaseFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\Drivers\Oracle\Factory
*/
class OracleDatabaseFactory extends DatabaseFactory
{
    /**
     * @param OracleConnection $connection
    */
    public function __construct(
        protected OracleConnection $connection
    ) {
    }




    /**
     * @inheritDoc
    */
    public function createDatabase(string $name): DatabaseInterface
    {
        return new OracleDatabase($this->connection, $name);
    }
}
