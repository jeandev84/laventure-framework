<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\Factory\ConnectionFactoryInterface;
use Laventure\Component\Database\Drivers\DriverException;
use Laventure\Component\Database\Query\Logger\QueryLoggerInterface;

/**
 * Connection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection
*/
abstract class Connection implements ConnectionInterface
{
    /**
     * @var ConfigurationInterface
    */
    protected $config;


    
    
    
    
    /**
     * @var ConnectionFactoryInterface
    */
    protected $factory;


    
    
    /**
     * @var mixed
    */
    protected mixed $connection;




    /**
     * @var QueryLoggerInterface
    */
    protected QueryLoggerInterface $queryLogger;


    
    
    
    
    
    /**
     * @param ConnectionFactoryInterface $factory
    */
    public function __construct(ConnectionFactoryInterface $factory)
    {
        $this->factory = $factory;
        $this->config  = new NullConfiguration();
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
    */
    public function connect(): static
    {
        return $this->connectionProcess();
    }









    /**
     * @param mixed $connection
     *
     * @return $this
    */
    public function setConnection(mixed $connection): static
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
     * @return ConfigurationInterface
    */
    public function getConfiguration(): ConfigurationInterface
    {
        return $this->config;
    }
    
    
    


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
     * @return QueryLoggerInterface
    */
    public function getQueryLogger(): QueryLoggerInterface
    {
        return $this->queryLogger;
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
     * @return $this
    */
    private function connectionProcess(): static
    {
         $config = $this->getConfiguration();

         $this->makeSureIsAvailable();

         $this->connectWithoutDatabase($config);

         if ($this->getDatabase()->exists()) {
            $this->connectIfDatabaseExists($config);
         }

         return $this;
    }





    /**
     * Determine if connection is available
     *
     * @return void
    */
    abstract protected function makeSureIsAvailable(): void;






    /**
     * connect without database
     *
     * @param ConfigurationInterface $config
     * @return $this
    */
    abstract protected function connectWithoutDatabase(ConfigurationInterface $config): static;






    /**
     * PdoConnection to the database if exists
     *
     * @param ConfigurationInterface $config
     * @return $this
    */
    abstract protected function connectIfDatabaseExists(ConfigurationInterface $config): static;
}