<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Manager;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Drivers\Mysql\MysqlConnection;
use Laventure\Component\Database\Connection\Drivers\Oracle\OracleConnection;
use Laventure\Component\Database\Connection\Drivers\Pgsql\PgsqlConnection;
use Laventure\Component\Database\Connection\Drivers\Sqlite\SqliteConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Config\PdoConfiguration;
use Laventure\Component\Database\Schema\Migrator\Migrator;
use Laventure\Component\Database\Schema\Migrator\MigratorInterface;
use Laventure\Component\Database\Schema\Schema;
use Laventure\Component\Database\Schema\SchemaInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

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



    /**
     * @var array
    */
    protected array $credentials = [];





    public function __construct()
    {
        parent::__construct($this->getDefaultConnections());
    }





    /**
     * @param array $credentials
     * @return $this
    */
    public function addCredentials(array $credentials): static
    {
        $this->credentials = $credentials;

        return $this;
    }

    
    


    /**
     * @return $this
    */
    public function bootConnection(): static
    {
        return $this->open(
            $this->config()->getConnection(),
            new Configuration($this->config()->getCredentials())
        );
    }






    /**
     * @param string $name
     * @return TableInterface
    */
    public function table(string $name): TableInterface
    {
        return $this->connection()->createTable($name);
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
     * @return ManagerConfiguration
    */
    public function config(): ManagerConfiguration
    {
        return new ManagerConfiguration($this->credentials);
    }

    




    /**
     * @return static
    */
    public static function instance(): static
    {
        if (!static::$instance) {
            static::$instance = new self();
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
