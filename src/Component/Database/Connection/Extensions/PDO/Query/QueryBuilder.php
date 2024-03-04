<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Criteria\PDO\SQLCriteriaResolverPDO;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Insert\PDO\InsertResolverPDO;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Expr\ExpressionInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Set\PDO\SettableResolverPDO;
use Laventure\Component\Database\Connection\Query\Builder\SQLQueryBuilder;
use Laventure\Component\Database\Connection\Query\Builder\SQLQueryBuilderInterface;

/**
 * PdoBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Query
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
    public function expr(): ExpressionInterface
    {
        return $this->builder->expr();
    }




    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {
         $select = $this->builder->select($selects);
         $select->addCriteriaResolver(new SQLCriteriaResolverPDO($select));
         return $select;
    }





    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertBuilderInterface
    {
        $insert = $this->builder->insert($table);
        $insert->addInsertResolver(new InsertResolverPDO($insert));
        return $insert;
    }





    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {
        $update = $this->builder->update($table);
        $update->addCriteriaResolver(new SQLCriteriaResolverPDO($update));
        $update->addSetResolver(new SettableResolverPDO($update));
        return $update;
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {
        $delete = $this->builder->delete($table);
        $delete->addCriteriaResolver(new SQLCriteriaResolverPDO($delete));
        return $delete;
    }
}
