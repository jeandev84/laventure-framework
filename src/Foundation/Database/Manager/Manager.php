<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Drivers\Mysql\MysqlConnection;
use Laventure\Component\Database\Drivers\Oracle\OracleConnection;
use Laventure\Component\Database\Drivers\Pgsql\PgsqlConnection;
use Laventure\Component\Database\Drivers\Sqlite\SqliteConnection;
use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Schema\Migrator\Migrator;
use Laventure\Component\Database\Schema\Migrator\MigratorInterface;
use Laventure\Component\Database\Schema\Schema;
use Laventure\Component\Database\Schema\SchemaInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;
use Laventure\Foundation\Database\Manager\Config\ManagerConfiguration;
use Laventure\Foundation\Database\Manager\Config\ManagerConfigurationInterface;

/**
 * Manager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database
*/
class Manager extends DatabaseManager implements ManagerInterface
{
    /**
     * @var static
    */
    protected static $instance;


    protected $loader;


    /**
     * ActiveRecord configuration manager
     *
     * @var array
    */
    protected array $credentials = [
        'connection'    => null,
        'extension'     => null,
        'credentials'   => [],
        'connections'   => [],
        'orm'           => []
    ];





    public function __construct()
    {
        parent::__construct($this->getDefaultConnections());
    }





    /**
     * @inheritdoc
    */
    public function addCredentials(array $credentials): static
    {
        $this->credentials = array_merge(
            $this->credentials,
            $credentials
        );

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function bootManager(): static
    {
        return $this->setConnectionName($this->getConfiguration()->connection())
                    ->setConfigurations();
    }






    /**
     * @inheritdoc
    */
    public function table(string $name, string $connection = null): TableInterface
    {
        return $this->connection($connection)->table($name);
    }






    /**
     * @inheritdoc
    */
    public function schema(string $connection = null): SchemaInterface
    {
        return new Schema($this->connection($connection));
    }





    /**
     * @inheritdoc
    */
    public function migration(string $connection = null): MigratorInterface
    {
        return new Migrator($this->connection($connection));
    }







    /**
     * @inheritdoc
    */
    public function getConfiguration(): ManagerConfigurationInterface
    {
        return new ManagerConfiguration($this->credentials);
    }







    /**
     * @return static
    */
    public static function getInstance(): static
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






    /**
     * @return array
    */
    public function getAllCredentials(): array
    {
        return $this->getConfiguration()->connections();
    }




    /**
     * @return $this
    */
    private function setConfigurations(): static
    {
        foreach ($this->getAllCredentials() as $name => $credentials) {
            $this->setConfiguration($name, new Configuration($credentials));
        }

        return $this;
    }
}
