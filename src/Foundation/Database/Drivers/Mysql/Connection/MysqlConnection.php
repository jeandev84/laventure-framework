<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Drivers\Mysql\Connection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Connection\Transaction\Contract\TransactionInterface;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;
use Laventure\Foundation\Database\Drivers\DriverName;
use Laventure\Foundation\Database\Drivers\Mysql\Collection\MysqlDatabaseCollection;
use Laventure\Foundation\Database\Drivers\Mysql\Connection\Transaction\MysqlTransaction;
use Laventure\Foundation\Database\Drivers\Mysql\Factory\MysqlDatabaseFactory;
use Laventure\Foundation\Database\Drivers\Mysql\Query\Builder\MysqlQueryBuilder;
use Laventure\Foundation\Database\Drivers\Mysql\Schema\Table\MysqlTable;

/**
 * MysqlConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Mysql
*/
class MysqlConnection extends PdoConnection
{
    /**
     * @inheritdoc
    */
    public function getName(): string
    {
        return DriverName::Mysql;
    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new MysqlQueryBuilder($this->createPdoQueryBuilder());
    }





    /**
     * @inheritDoc
    */
    public function table(string $name): TableInterface
    {
        return new MysqlTable($this, $name);
    }




    
    
    
    /**
     * @inheritDoc
    */
    public function transaction(): TransactionInterface
    {
        return new MysqlTransaction($this);
    }
    
    
    
    


    /**
     * @inheritDoc
    */
    public function getDatabaseNames(): array
    {
        return $this->statement("SHOW DATABASES;")
                    ->fetch()
                    ->columns();
    }





    /**
     * @inheritDoc
    */
    public function getDatabaseFactory(): DatabaseFactoryInterface
    {
        return new MysqlDatabaseFactory($this);
    }






    /**
     * @inheritDoc
    */
    public function getDatabaseCollection(): DatabaseCollectionInterface
    {
        return new MysqlDatabaseCollection($this->getDatabases());
    }
}
