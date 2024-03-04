<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli;

use Laventure\Component\Database\Connection\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\ConnectionName;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Factory\MysqliConnectionFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Query\Query;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Query\QueryBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Mysql\MysqlDatabase;
use Laventure\Component\Database\Connection\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;
use Laventure\Component\Database\Connection\Traits\ConnectionTrait;
use Laventure\Component\Database\DatabaseInterface;
use mysqli;

/**
 * MysqliConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\Mysqli
*/
class MysqliConnection implements MysqliConnectionInterface
{
    use ConnectionTrait;


    /**
     * @var MysqliConnectionFactoryInterface
    */
    protected MysqliConnectionFactoryInterface $factory;



    /**
     * @param MysqliConnectionFactoryInterface $factory
    */
    public function __construct(MysqliConnectionFactoryInterface $factory)
    {
        $this->factory = $factory;
    }



    /**
     * @inheritDoc
    */
    public function connect(ConfigurationInterface $config): void
    {
        $this->withConnection($this->factory->makeConnection($config))
             ->withConfiguration($config);
    }





    /**
     * @inheritDoc
    */
    public function connected(): bool
    {
        return $this->connection instanceof mysqli;
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
        $this->withConfiguration(new NullConfiguration());
        $this->disconnect();
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
    public function getConnection(): mysqli
    {
        return $this->connection;
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
    public function getDatabase(): DatabaseInterface
    {
        return new MysqlDatabase($this);
    }





    /**
     * @inheritDoc
    */
    public function activateTransaction(): void
    {
        $this->executeQuery('SET autocommit = 1');
    }




    /**
     * @inheritDoc
    */
    public function beginTransaction(): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function hasActiveTransaction(): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function transaction(callable $func): mixed
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function transactionIf(callable $func, bool $condition = false): mixed
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function disableTransaction(): void
    {
        $this->executeQuery('SET autocommit = 0');
    }




    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return ConnectionName::Mysqli;
    }




    /**
     * @inheritDoc
    */
    public function makeMysqli(ConfigurationInterface $config): mysqli
    {

    }
}
