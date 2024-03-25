<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Common;

use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLQueryBuilderFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;

/**
 * AbstractSQLQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers
*/
abstract class AbstractSQLQueryBuilder implements SQLQueryBuilderInterface
{
    /**
     * @var SQLQueryBuilderInterface
    */
    protected SQLQueryBuilderInterface $builder;


    /**
     * @param SQLQueryBuilderInterface $builder
    */
    public function __construct(SQLQueryBuilderInterface $builder)
    {
        $this->builder = $builder;
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {
        return $this->builder->expr();
    }
}
