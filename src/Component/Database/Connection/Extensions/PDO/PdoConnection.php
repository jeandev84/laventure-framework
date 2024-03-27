<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\Connection;
use Laventure\Component\Database\Connection\ConnectionTrait;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory\PdoDsnBuilderFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory\PdoDsnBuilderFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilderInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Reader\PdoDsnReader;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\Factory\PdoSQLQueryBuilderFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Query;
use Laventure\Component\Database\Connection\Factory\ConnectionFactoryInterface;
use Laventure\Component\Database\Drivers\DriverException;
use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLQueryBuilderFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use PDO;
use PDOException;
use RuntimeException;

/**
 * PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO
*/
abstract class PdoConnection extends Connection implements PdoConnectionInterface
{

    /**
     * @param PdoConnectionFactoryInterface|null $factory
    */
    public function __construct(PdoConnectionFactoryInterface $factory = null)
    {
        parent::__construct($factory ?: new PdoConnectionFactory());
    }





    /**
     * @return $this
    */
    public function connectToPdo(): static
    {
        $config = $this->getConfiguration();

        if (!$this->hasPdoDsn()) {
            throw new RuntimeException("No DSN specified for making connection.");
        }

        return $this->setConnection($this->makePdo($config))->config($config);
    }






    /**
     * @inheritdoc
    */
    public function connected(): bool
    {
        return $this->connection instanceof PDO;
    }







    /**
     * @inheritdoc
    */
    public function createQuery(): QueryInterface
    {
        return new Query($this->getConnection(), $this->queryLogger);
    }






    /**
     * @return SQLQueryBuilderInterface
    */
    public function createPdoQueryBuilder(): SQLQueryBuilderInterface
    {
        return $this->createBuilderFactory()->createBuilder();
    }





    /**
     * @return SQLQueryBuilderFactoryInterface
    */
    public function createBuilderFactory(): SQLQueryBuilderFactoryInterface
    {
        return new PdoSQLQueryBuilderFactory($this);
    }








    /**
     * @inheritdoc
    */
    public function beginTransaction(): bool
    {
        return $this->getConnection()->beginTransaction();
    }






    /**
     * @inheritdoc
    */
    public function hasActiveTransaction(): bool
    {
        return $this->getConnection()->inTransaction();
    }





    /**
     * @inheritdoc
    */
    public function commit(): bool
    {
        return $this->getConnection()->commit();
    }







    /**
     * @inheritdoc
    */
    public function rollback(): bool
    {
        return $this->getConnection()->rollBack();
    }







    /**
     * @inheritdoc
    */
    public function transaction(callable $func): bool
    {
        try {

            $this->beginTransaction();
            $func($this);
            return $this->commit();

        } catch (PDOException $e) {

            if ($this->hasActiveTransaction()) {
                $this->rollBack();
            }

            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }







    /**
     * @inheritdoc
    */
    public function makePdo(ConfigurationInterface $config): PDO
    {
        return $this->factory->makeConnection($config);
    }






    /**
     * @inheritdoc
    */
    public function getConnection(): PDO
    {
        return $this->connection;
    }






    /**
     * @return bool
    */
    public function isAvailable(): bool
    {
        return $this->hasAvailableDriver($this->getName());
    }






    /**
     * @inheritdoc
    */
    public function hasAvailableDriver(string $driver): bool
    {
        return in_array($driver, $this->getAvailableDrivers());
    }






    /**
     * @inheritdoc
    */
    public function getAvailableDrivers(): array
    {
        return PDO::getAvailableDrivers();
    }







    /**
     * Determine if has dsn parameter
     *
     * @return bool
    */
    public function hasPdoDsn(): bool
    {
        return $this->config->has('dsn');
    }






    /**
     * @param string $dsn
     * @return $this
    */
    public function setPdoDsn(string $dsn): static
    {
         $this->config->add(compact('dsn'));

         return $this;
    }







    /**
     * @inheritDoc
    */
    protected function makeSureIsAvailable(): void
    {
        if (!$this->isAvailable()) {
            throw new DriverException("Unavailable driver {$this->getName()}");
        }
    }





    /**
     * @inheritdoc
     * @param ConfigurationInterface $config
     * @return PdoConnection
    */
    protected function connectWithoutDatabase(): static
    {
        if (!$this->hasPdoDsn()) {
            $this->setPdoDsn($this->getDsnBuilder()->buildDefault());
        }

        return $this->connectToPdo();
    }






    /**
     * @inheritdoc
     * @param ConfigurationInterface $config
     * @return PdoConnection
    */
    protected function connectIfDatabaseExists(): static
    {
        $this->setPdoDsn($this->getDsnBuilder()->buildIfDatabaseExists());

        return $this->connectToPdo();
    }






    /**
     * @inheritDoc
    */
    public function getDsnBuilder(): PdoDsnBuilderInterface
    {
        return $this->getPdoDsnBuilderFactory()->create($this->getConfiguration());
    }






    /**
     * @inheritDoc
    */
    public function getPdoDsnBuilderFactory(): PdoDsnBuilderFactoryInterface
    {
        return new PdoDsnBuilderFactory();
    }
}
