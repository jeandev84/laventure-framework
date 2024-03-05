<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;


use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsnBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Query;
use Laventure\Component\Database\Connection\Traits\ConnectionTrait;
use Laventure\Component\Database\Query\QueryInterface;
use PDO;
use PDOException;
use RuntimeException;

/**
 * PdoConnectionTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO
*/
trait PdoConnectionTrait
{
    use ConnectionTrait;


    /**
     * @var PdoConnectionFactoryInterface
    */
    protected PdoConnectionFactoryInterface $factory;


    /**
     * @var mixed
    */
    protected mixed $func;



    public function __construct()
    {
        $this->factory = new PdoConnectionFactory();
    }




    /**
     * @return string
    */
    abstract public function getName(): string;





    /**
     * @param ConfigurationInterface $config
     * @return $this
    */
    public function connect(ConfigurationInterface $config): static
    {
        $this->connectBefore($config);

        if ($this->getDatabase()->exists()) {
           $this->connectAfter($config);
        }

        return $this;
    }






    /**
     * @return bool
     */
    public function connected(): bool
    {
        return $this->connection instanceof PDO;
    }







    /**
     * @return void
     */
    public function disconnect(): void
    {
        $this->connection = null;
    }





    /**
     * @return void
     */
    public function purge(): void
    {
        $this->withConfiguration(new NullConfiguration())
             ->disconnect();
    }






    /**
     * @return bool
     */
    public function disconnected(): bool
    {
        return is_null($this->connection);
    }






    /**
     * @return QueryInterface
     */
    public function createQuery(): QueryInterface
    {
        return new Query($this->getConnection());
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
     * @param string $sql
     * @return mixed
     */
    public function executeQuery(string $sql): mixed
    {
        return $this->createQuery()->exec($sql);
    }





    /**
     * @return bool
     */
    public function beginTransaction(): bool
    {
        return $this->getConnection()->beginTransaction();
    }






    /**
     * @return bool
     */
    public function hasActiveTransaction(): bool
    {
        return $this->getConnection()->inTransaction();
    }





    /**
     * @return bool
     */
    public function commit(): bool
    {
        return $this->getConnection()->commit();
    }







    /**
     * @return bool
     */
    public function rollback(): bool
    {
        return $this->getConnection()->rollBack();
    }







    /**
     * @param callable $func
     * @return bool
     */
    public function transaction(callable $func): bool
    {
        try {

            $this->beginTransaction();
            $this->func = $func($this);
            return $this->commit();

        } catch (PDOException $e) {

            if ($this->hasActiveTransaction()) {
                $this->rollBack();
            }

            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }






    /**
     * @param callable $func
     * @param bool $condition
     * @return mixed
     */
    public function transactionIf(callable $func, bool $condition = false): mixed
    {
        if ($condition) {
            $this->transaction($func);
            return $this->func;
        }

        return $condition;
    }






    /**
     * @param ConfigurationInterface $config
     * @return PDO
    */
    public function makePdo(ConfigurationInterface $config): PDO
    {
        if (!$config->has('dsn')) {
            throw new RuntimeException("No DSN specified for making connection.");
        }

        $config->add($this->getDsnParamsFromString($config['dsn']));

        $this->withConfiguration($config);

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
        return in_array($this->getName(), $this->getAvailableDrivers());
    }






    /**
     * @param string $driver
     * @return bool
    */
    public function hasDriver(string $driver): bool
    {
        return in_array($driver, $this->getAvailableDrivers());
    }





    /**
     * @return array
    */
    public function getAvailableDrivers(): array
    {
        return PDO::getAvailableDrivers();
    }





    /**
     * @param string $driver
     * @param array $params
     * @return string
    */
    private function makePdoDsn(string $driver, array $params): string
    {
        return PdoDsnBuilder::create($driver, $params);
    }




    /**
     * @param ConfigurationInterface $config
     * @return $this
    */
    private function connectBefore(ConfigurationInterface $config): static
    {
        if (!$config->has('dsn')) {
            $config['dsn'] = $this->makeDefaultDsn($config);
        }

        return $this->withConnection($this->makePdo($config));
    }






    /**
     * @param ConfigurationInterface $config
     * @return $this
    */
    private function connectAfter(ConfigurationInterface $config): static
    {
        $config['dsn'] = $this->makeDsnIfDatabaseExists($config);
        return $this->withConnection($this->makePdo($config));
    }








    /**
     * @param string $dsn
     * @return array
    */
    private function getDsnParamsFromString(string $dsn): array
    {
        $config = [];
        [$driver, $options] = explode(':', $dsn, 2);
        $params = explode(';', $options);
        $config['driver'] = $driver;

        foreach ($params as $attributes) {
            [$key, $value] = explode('=', $attributes, 2);
            $params[$key] = $value;
        }

        return $config;
    }





    /**
     * @param ConfigurationInterface $config
     * @return string
    */
    private function makeDefaultDsn(ConfigurationInterface $config): string
    {
        return $this->makePdoDsn($config['driver'], [
            'host'     => $config['host'],
            'port'     => $config['port'],
            'charset'  => $config['charset']
        ]);
    }





    /**
     * @param ConfigurationInterface $config
     * @return string
    */
    private function makeDsnIfDatabaseExists(ConfigurationInterface $config): string
    {
        if ($config->has('dsn')) {
            return rtrim($config['dsn'], ';') . ";dbname={$config->database()};";
        }

        return $this->makePdoDsn($config['driver'], [
            'host'     => $config['host'],
            'port'     => $config['port'],
            'dbname'   => $config['database'],
            'charset'  => $config['charset']
        ]);
    }
}