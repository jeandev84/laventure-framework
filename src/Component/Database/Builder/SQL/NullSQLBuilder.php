<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\Expr\ExpressionInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\NullConnection;
use Laventure\Component\Database\Connection\Query\NullQuery;
use Laventure\Component\Database\Connection\Query\QueryInterface;

/**
 * NullSqlBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
class NullSQLBuilder implements SQLBuilderInterface
{
    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return '';
    }



    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return new NullConnection();
    }




    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        return new NullQuery();
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {
        throw new \RuntimeException("Could not found expression for null sql builder.");
    }
}
