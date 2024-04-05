<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\Factory\ConnectionFactoryInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Query\Logger\QueryLogger;
use Laventure\Component\Database\Query\Logger\QueryLoggerInterface;
use Laventure\Component\Database\Query\QueryInterface;

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
    protected ConfigurationInterface $config;






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
        $this->factory     = $factory;
        $this->config      = new NullConfiguration();
        $this->queryLogger = new QueryLogger();
    }






    /**
     * @param ConfigurationInterface $config
     * @return $this
    */
    public function parse(ConfigurationInterface $config): static
    {
        $this->config = $config;

        return $this;
    }






    /**
     * @return $this
    */
    public function connect(): static
    {
        $this->makeSureIsAvailable();
        $this->connectWithoutDatabase();

        if ($this->getDatabase()->exists()) {
            $this->connectIfDatabaseExists();
        }

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function disconnect(): void
    {
        $this->connection = null;
    }





    /**
     * @inheritdoc
    */
    public function purge(): void
    {
        $this->parse(new NullConfiguration())->disconnect();
    }






    /**
     * @inheritdoc
     */
    public function disconnected(): bool
    {
        return is_null($this->connection);
    }








    /**
     * @param string $sql
     * @return QueryInterface
    */
    public function statement(string $sql): QueryInterface
    {
        return $this->createQuery()->prepare($sql);
    }







    /**
     * @inheritdoc
     */
    public function exec(string $sql): int|bool
    {
        return $this->createQuery()->executeQuery($sql);
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
     * @inheritDoc
    */
    public function getConnection(): mixed
    {
        return $this->connection;
    }






    /**
     * @inheritDoc
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
     * @return DatabaseInterface
    */
    public function getDatabase(): DatabaseInterface
    {
        return $this->getDatabaseFactory()->createDatabase($this->getDatabaseName());
    }





    /**
     * @inheritDoc
    */
    public function getDatabases(): array
    {
        return $this->getDatabaseFactory()->createDatabases($this->getDatabaseNames());
    }






    /**
     * Determine if connection is available
     *
     * @return void
    */
    abstract public function makeSureIsAvailable(): void;





    /**
     * connect without database
     *
     * @return $this
    */
    abstract public function connectWithoutDatabase(): static;






    /**
     * PdoConnection to the database if exists
     * @return $this
    */
    abstract public function connectIfDatabaseExists(): static;
}
