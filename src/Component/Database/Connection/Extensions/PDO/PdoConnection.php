<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Connection;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory\PdoDsnBuilderFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory\PdoDsnBuilderFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilderInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\PdoQueryBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Query;
use Laventure\Component\Database\Connection\Extensions\PDO\Transaction\Transaction;
use Laventure\Component\Database\Connection\Transaction\Contract\TransactionInterface;
use Laventure\Component\Database\Drivers\DriverException;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use PDO;
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

        return $this->setConnection($this->makePdo($config))->parse($config);
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
     * @return QueryBuilderInterface
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return new PdoQueryBuilder($this);
    }






    /**
     * @inheritDoc
    */
    public function transaction(): TransactionInterface
    {
        return new Transaction($this);
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
    public function makeSureIsAvailable(): void
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
    public function connectWithoutDatabase(): static
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
    public function connectIfDatabaseExists(): static
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





    /**
     * @inheritDoc
    */
    public function config($id, $default = null): mixed
    {
        return $this->getConfiguration()->get($id, $default);
    }
}
