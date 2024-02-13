<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;


use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Builder\SqlQueryBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Resolver\ConditionResolver;
use Laventure\Component\Database\Connection\Extensions\PDO\Resolver\InsertResolver;
use Laventure\Component\Database\Connection\Extensions\PDO\Resolver\UpdateResolver;

/**
 * QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder
 */
class QueryBuilder implements QueryBuilderInterface
{


    /**
     * @var SqlQueryBuilder
    */
    protected SqlQueryBuilder $builder;



    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->builder = new SqlQueryBuilder($connection);
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
    public function select($selects = null, array $criteria = []): SelectBuilderInterface
    {
        $conditionResolver = new ConditionResolver($this->builder->select($selects));
        return $conditionResolver->resolve($criteria);
    }




    /**
     * @inheritDoc
    */
    public function insert(string $table, array $attributes): InsertBuilderInterface
    {
         $resolver = new InsertResolver($this->builder->insert($table));
         return $resolver->resolve($attributes);
    }






    /**
     * @inheritDoc
    */
    public function update(string $table, array $attributes, array $criteria = []): UpdateBuilderInterface
    {
         $resolver          = new UpdateResolver($this->builder->update($table));
         $conditionResolver = new ConditionResolver($resolver->resolve($attributes));
         return $conditionResolver->resolve($criteria);
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table, array $criteria = []): DeleteBuilderInterface
    {
        $conditionResolver = new ConditionResolver($this->builder->delete($table));
        return $conditionResolver->resolve($criteria);
    }
}