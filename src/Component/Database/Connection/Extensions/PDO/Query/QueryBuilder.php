<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query;

use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Resolver\CriteriaResolver;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Resolver\InsertResolver;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Resolver\UpdateResolver;
use Laventure\Component\Database\Query\Builder\Builder;

/**
 * PdoBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Query
*/
class QueryBuilder extends Builder
{
    /**
     * @param PdoConnection $connection
    */
    public function __construct(PdoConnection $connection)
    {
        parent::__construct($connection);
    }



    /**
     * @inheritDoc
    */
    public function select(string $columns = null, array $criteria = []): SelectBuilderInterface
    {
        $conditionResolver = new CriteriaResolver($this->builder->select($columns));
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
        $conditionResolver = new CriteriaResolver($resolver->resolve($attributes));
        return $conditionResolver->resolve($criteria);
    }




    /**
     * @inheritDoc
     */
    public function delete(string $table, array $criteria = []): DeleteBuilderInterface
    {
        $conditionResolver = new CriteriaResolver($this->builder->delete($table));
        return $conditionResolver->resolve($criteria);
    }
}
