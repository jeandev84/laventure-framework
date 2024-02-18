<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\NullConfiguration;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsn;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsnBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Query;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\QueryBuilder;
use Laventure\Component\Database\Connection\Traits\ConnectionTrait;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
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
 * @package  Laventure\Component\Database\Connection\Extensions\PDO
*/
abstract class PdoConnection implements PdoConnectionInterface
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





    /**
     * @param PdoConnectionFactoryInterface $factory
    */
    public function __construct(PdoConnectionFactoryInterface $factory)
    {
        $this->factory  = $factory;
        $this->withConfiguration(new NullConfiguration());
    }





    /**
     * @inheritDoc
    */
    public function connect(ConfigurationInterface $config): void
    {
        $this->withConnection($this->makeConnection($config));
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
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return new QueryBuilder($this);
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
     * @inheritDoc
    */
    public function beginTransaction(): bool
    {
        return $this->getConnection()->beginTransaction();
    }




    /**
     * @inheritDoc
    */
    public function hasActiveTransaction(): bool
    {
        return $this->getConnection()->inTransaction();
    }






    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        return $this->getConnection()->commit();
    }





    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
        return $this->getConnection()->rollBack();
    }






    /**
     * @inheritDoc
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
     * @inheritDoc
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
    public function makeConnection(ConfigurationInterface $config): PDO
    {
        $this->withConfiguration($config);

        return $this->factory->make($this->getName(), $config);
    }






    /**
     * @inheritdoc
    */
    public function getConnection(): PDO
    {
        return $this->connection;
    }






    /**
     * @inheritdoc
    */
    public function getDatabaseName(): string
    {
        if ($database = $this->config->database()) {
            return $database;
        }

        $dsn = $this->getDsn();

        if (!$database = $dsn['dbname']) {
            throw new RuntimeException(
                "Could not retrieve database name from (". $dsn . ")"
            );
        }

        return $database;
    }





    /**
     * @return PdoDsn
    */
    public function getDsn(): PdoDsn
    {
        return new PdoDsn($this->config('dsn'));
    }
}
