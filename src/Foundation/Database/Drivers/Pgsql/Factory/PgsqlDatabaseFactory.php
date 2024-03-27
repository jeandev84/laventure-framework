<?php
declare(strict_types=1);

namespace Laventure\Foundation\Database\Drivers\Pgsql\Factory;

use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Factory\DatabaseFactory;
use Laventure\Foundation\Database\Drivers\Pgsql\Connection\PgsqlConnection;
use Laventure\Foundation\Database\Drivers\Pgsql\PgsqlDatabase;

/**
 * PgsqlDatabaseFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers\Pgsql\Factory
*/
class PgsqlDatabaseFactory extends DatabaseFactory
{

    /**
     * @param PgsqlConnection $connection
    */
    public function __construct(
        protected PgsqlConnection $connection
    )
    {
    }



    /**
     * @inheritDoc
    */
    public function createDatabase(string $name): DatabaseInterface
    {
        return new PgsqlDatabase($this->connection, $name);
    }
}