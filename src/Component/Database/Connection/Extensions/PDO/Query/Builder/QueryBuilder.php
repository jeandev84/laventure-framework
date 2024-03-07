<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DML\PdoDeleteBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DML\PdoInsertBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DML\PdoUpdateBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DQL\PdoSelectBuilder;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;

/**
 * PdoBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Query
*/
class QueryBuilder implements SQLQueryBuilderInterface
{
    /**
     * @var SQLQueryBuilder
    */
    protected SQLQueryBuilder $builder;



    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->builder = new SQLQueryBuilder($connection);
    }





    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {
        return $this->builder->expr();
    }






    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {
        return new PdoSelectBuilder($this->builder->select($selects));
    }





    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertBuilderInterface
    {
        return new PdoInsertBuilder($this->builder->insert($table));
    }





    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {
        return new PdoUpdateBuilder($this->builder->update($table));
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {
        return new PdoDeleteBuilder($this->builder->delete($table));
    }
}
