<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;


use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\Common\AbstractConnection;
use Laventure\Component\Database\Connection\Drivers\DriverException;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Reader\PdoDsnReader;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\Factory\PdoSQLQueryBuilderFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Query;
use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLQueryBuilderFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use PDO;
use PDOException;
use RuntimeException;


/**
 * Connection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO
*/
abstract class Connection extends AbstractConnection implements PdoConnectionInterface
{
    /**
     * @var PdoConnectionFactoryInterface
    */
    protected PdoConnectionFactoryInterface $factory;



    /**
     * @param PdoConnectionFactoryInterface|null $factory
     */
    public function __construct(PdoConnectionFactoryInterface $factory = null)
    {
        $this->factory = $factory ?: new PdoConnectionFactory();
    }






    /**
     * @inheritdoc
    */
    public function connectToPdo(ConfigurationInterface $config): static
    {
        if (!$config->has('dsn')) {
            throw new RuntimeException("No DSN specified for making connection.");
        }

        return $this->withConnection($this->makePdo($config))
                    ->withConfiguration($config);
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
    public function disconnect(): void
    {
        $this->connection = null;
    }





    /**
     * @inheritdoc
    */
    public function purge(): void
    {
        $this->withConfiguration(new NullConfiguration())->disconnect();
    }






    /**
     * @inheritdoc
    */
    public function disconnected(): bool
    {
        return is_null($this->connection);
    }






    /**
     * @inheritdoc
    */
    public function createQuery(): QueryInterface
    {
        return new Query($this->getConnection());
    }





    /**
     * @inheritdoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return $this->createSQLBuilderFactory()
                    ->createBuilder();
    }





    /**
     * @inheritdoc
    */
    public function createSQLBuilderFactory(): SQLQueryBuilderFactoryInterface
    {
         return new PdoSQLQueryBuilderFactory($this);
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
    public function executeQuery(string $sql): mixed
    {
        return $this->createQuery()->exec($sql);
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
     * @inheritdoc
    */
    public function connectWithoutDatabase(ConfigurationInterface $config): static
    {
        if (!$config->has('dsn')) {
            $config['dsn'] = $this->makeDefaultDsn($config);
        }

        return $this->connectToPdo($config);
    }






    /**
     * @inheritdoc
    */
    public function connectIfExistsDatabase(ConfigurationInterface $config): static
    {
        $config['dsn'] = $this->makeDsnIfDatabaseExists($config);

        return $this->connectToPdo($config);
    }








    /**
     * @param string $dsn
     * @return array
    */
    private function readDsnParams(string $dsn): array
    {
        return (new PdoDsnReader($dsn))
               ->read();
    }




    /**
     * @param ConfigurationInterface $config
     * @return string
     * @throws DriverException
    */
    private function makeDefaultDsn(ConfigurationInterface $config): string
    {
        return $this->makePdoDsn($config->required('driver'), [
            'host'     => $config->getHost(),
            'port'     => $config->getPort(),
            'charset'  => $config->getCharset()
        ]);
    }





    /**
     * @param ConfigurationInterface $config
     * @return string
    */
    private function makeDsnIfDatabaseExists(ConfigurationInterface $config): string
    {
        return $this->makePdoDsn($config->required('driver'), [
            'host'     => $config->getHost(),
            'port'     => $config->getPort(),
            'dbname'   => $config->getDatabase(),
            'charset'  => $config->getCharset()
        ]);
    }




    /**
     * @param string $driver
     * @param array $params
     * @return string
     * @throws DriverException
    */
    private function makePdoDsn(string $driver, array $params): string
    {
        if (!$this->hasAvailableDriver($driver)) {
           throw new DriverException(
        "unavailable driver $driver. Please try to install it."
           );
        }

        return PdoDsnBuilder::create($driver, $params);
    }
}