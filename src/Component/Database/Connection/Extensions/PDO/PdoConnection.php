<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Connection\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsn;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsnBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Query;
use Laventure\Component\Database\Connection\Query\Builder\SQLQueryBuilderInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;
use Laventure\Component\Database\Connection\Traits\ConnectionTrait;
use PDO;
use PDOException;

/**
 * PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO
*/
class PdoConnection implements PdoConnectionInterface
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
     * @inheritDoc
    */
    public function connect(ConfigurationInterface $config): void
    {
        $this->withConnection($this->makePdo($config));
    }






    /**
     * @inheritDoc
    */
    public function connected(): bool
    {
        return $this->connection instanceof PDO;
    }





    /**
     * @inheritDoc
    */
    public function disconnect(): void
    {
        $this->connection = null;
    }





    /**
     * @inheritDoc
    */
    public function purge(): void
    {
        $this->withConfiguration(new NullConfiguration())
             ->disconnect();
    }




    /**
     * @inheritDoc
    */
    public function disconnected(): bool
    {
        return is_null($this->connection);
    }





    /**
     * @inheritDoc
    */
    public function createQuery(): QueryInterface
    {
        return new Query($this->getConnection());
    }





    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        #return new QueryBuilder($this);
    }





    /**
     * @inheritDoc
    */
    public function statement(string $sql): QueryInterface
    {
        return $this->createQuery()->prepare($sql);
    }




    /**
     * @inheritDoc
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
        return $this->makePdo()->beginTransaction();
    }






    /**
     * @return bool
    */
    public function hasActiveTransaction(): bool
    {
        return $this->makePdo()->inTransaction();
    }





    /**
     * @return bool
    */
    public function commit(): bool
    {
        return $this->makePdo()->commit();
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
     * @inheritdoc
    */
    public function makePdo(ConfigurationInterface $config): PDO
    {
        if (!$config->has('dsn')) {
            $config['dsn'] = $this->makePdoDsn($config);
        }

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
     * @return PdoDsn
    */
    public function getDsn(): PdoDsn
    {
        return new PdoDsn($this->config('dsn'));
    }





    /**
     * @inheritdoc
    */
    public function isAvailable(): bool
    {
        return in_array($this->getName(), $this->getAvailableDrivers());
    }




    /**
     * @inheritdoc
    */
    public function getAvailableDrivers(): array
    {
        return PDO::getAvailableDrivers();
    }





    /**
     * @param ConfigurationInterface $config
     * @return string
    */
    protected function makePdoDsn(ConfigurationInterface $config): string
    {
        return PdoDsnBuilder::create($config['driver'], [
            [
                'host'     => $config->host(),
                'port'     => $config->port(),
                'dbname'   => $config->database(),
                'charset'  => $config->charset()
            ]
        ]);
    }
}
