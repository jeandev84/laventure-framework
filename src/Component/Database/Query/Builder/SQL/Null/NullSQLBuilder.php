<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Null;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;
use Laventure\Component\Database\Query\Null\NullQuery;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * NullSqlBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
class NullSQLBuilder extends SQLBuilder
{


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
    public function expr(): ExpressionBuilderInterface
    {
        throw new \RuntimeException("Could not found expression for null sql builder.");
    }




    /**
     * @inheritDoc
    */
    protected function getCommands(): array
    {
        return [];
    }
}
