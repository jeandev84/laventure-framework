<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\ConnectionTrait;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Factory\MysqliConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Factory\MysqliConnectionFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Query\Query;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Drivers\DriverName;
use Laventure\Component\Database\Drivers\Mysql\MysqlDatabase;
use Laventure\Component\Database\Drivers\Mysql\Schema\Table\MysqlTable;
use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLQueryBuilderFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;
use mysqli;

/**
 * MysqliConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\Mysqli
*/
class MysqliConnection implements MysqliConnectionInterface
{
    use ConnectionTrait;

    /**
     * @var MysqliConnectionFactoryInterface
    */
    protected MysqliConnectionFactoryInterface $factory;




    /**
     * @param MysqliConnectionFactoryInterface|null $factory
    */
    public function __construct(MysqliConnectionFactoryInterface $factory = null)
    {
        $this->factory = $factory ?: new MysqliConnectionFactory();
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
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        //TODO returns here MysqlQueryBuilder()
        return new SQLQueryBuilder($this);
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
    public function enableTransaction(): void
    {
        $this->executeQuery('SET autocommit = 1');
    }




    /**
     * @inheritDoc
    */
    public function begin(): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function hasActive(): bool
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
        return DriverName::Mysqli;
    }





    /**
     * @inheritDoc
    */
    public function makeMysqli(ConfigurationInterface $config): mysqli
    {
        return $this->factory->makeConnection($config);
    }






    /**
     * @inheritDoc
    */
    public function table(string $name, string $schemaName = ''): TableInterface
    {
        return new MysqlTable($this, $name, $schemaName);
    }




    /**
     * @inheritDoc
    */
    public function getSQLBuilderFactory(): SQLQueryBuilderFactoryInterface
    {
        // TODO: Implement createSQLBuilderFactory() method.
    }

    /**
     * @inheritDoc
     */
    public function connectWithoutDatabase(ConfigurationInterface $config): mixed
    {
        // TODO: Implement connectWithoutDatabase() method.
    }

    /**
     * @inheritDoc
     */
    public function connectIfExistsDatabase(ConfigurationInterface $config): mixed
    {
        // TODO: Implement connectIfExistsDatabase() method.
    }
}
