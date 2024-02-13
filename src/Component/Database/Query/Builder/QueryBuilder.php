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
abstract class QueryBuilder implements QueryBuilderInterface
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

}