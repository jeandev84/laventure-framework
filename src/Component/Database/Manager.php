<?php

declare(strict_types=1);

namespace Laventure\Component\Database;

use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Mysql\MysqlConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Oracle\OracleConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Pgsql\PgsqlConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Sqlite\SqliteConnection;
use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Manager\Factory\DatabaseManagerFactory;
use Laventure\Component\Database\Migrator\Migrator;
use Laventure\Component\Database\Migrator\MigratorInterface;
use Laventure\Component\Database\Schema\Schema;
use Laventure\Component\Database\Schema\SchemaInterface;

/**
 * Manager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database
*/
class Manager extends DatabaseManager
{
    /**
     * @var static
    */
    protected static $instance;



    public function __construct()
    {
        parent::__construct($this->getDefaultConnections());
    }





    /**
     * @param string|null $name
     * @return SchemaInterface
    */
    public function schema(string $name = null): SchemaInterface
    {
        return new Schema($this->connection($name));
    }





    /**
     * @param string|null $name
     * @return MigratorInterface
    */
    public function migration(string $name = null): MigratorInterface
    {
        return new Migrator($this->connection($name));
    }





    /**
     * @return static
    */
    public static function instance(): static
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }





    /**
     * @return array
    */
    public function getDefaultConnections(): array
    {
        return [
            new MysqlConnection(),
            new PgsqlConnection(),
            new SqliteConnection(),
            new OracleConnection()
        ];
    }
}
