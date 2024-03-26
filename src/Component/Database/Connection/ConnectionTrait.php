<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Drivers\DriverException;
use Laventure\Component\Database\Query\Logger\QueryLoggerInterface;

/**
 * ConnectionTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection
 */
trait ConnectionTrait
{
    /**
     * @var ConfigurationInterface
     */
    protected $config;


    /**
     * @var mixed
    */
    protected mixed $connection;




    /**
     * @var QueryLoggerInterface
    */
    protected QueryLoggerInterface $queryLogger;





    /**
     * @param QueryLoggerInterface $queryLogger
     * @return $this
    */
    public function setQueryLogger(QueryLoggerInterface $queryLogger): static
    {
         $this->queryLogger = $queryLogger;

         return $this;
    }





    /**
     * @param ConfigurationInterface $config
     * @return $this
    */
    public function config(ConfigurationInterface $config): static
    {
        $this->config = $config;

        return $this;
    }





    /**
     * @return $this
     * @throws DriverException
    */
    public function connect(): static
    {
        $config = $this->getConfiguration();

        $this->makeSureIfIsAvailable();

        $this->connectWithoutDatabase($config);

        if ($this->getDatabase()->exists()) {
            $this->connectIfExistsDatabase($config);
        }

        return $this;
    }






    /**
     * @param mixed $connection
     *
     * @return $this
    */
    public function withConnection(mixed $connection): static
    {
        $this->connection = $connection;

        return $this;
    }




    /**
     * @return mixed
    */
    public function getConnection(): mixed
    {
        return $this->connection;
    }




    /**
     * @param ConfigurationInterface $config
     * @return $this
    */
    public function withConfiguration(ConfigurationInterface $config): static
    {
        $this->config = $config;

        return $this;
    }





    /**
     * @return ConfigurationInterface
    */
    public function getConfiguration(): ConfigurationInterface
    {
        if (!$this->config) {
            $this->config = new NullConfiguration();
        }

        return $this->config;
    }





    /**
     * Returns database name
     *
     * @return string
    */
    public function getDatabaseName(): string
    {
        return $this->config->getDatabase();
    }






    /**
     * @return QueryLoggerInterface
    */
    public function getQueryLogger(): QueryLoggerInterface
    {
        return $this->queryLogger;
    }




    /**
     * @return void
    */
    abstract protected function makeSureIfIsAvailable(): void;






    /**
     * connect without database
     *
     * @param ConfigurationInterface $config
     * @return mixed
    */
    abstract protected function connectWithoutDatabase(ConfigurationInterface $config): mixed;






    /**
     * PdoConnection to the database if exists
     *
     * @param ConfigurationInterface $config
     * @return $this
    */
    abstract protected function connectIfExistsDatabase(ConfigurationInterface $config): mixed;
}
