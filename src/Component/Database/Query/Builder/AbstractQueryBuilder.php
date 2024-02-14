<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;

use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Builder\SqlQueryBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * AbstractQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder
 */
abstract class AbstractQueryBuilder implements QueryBuilderInterface
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
