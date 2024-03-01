<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * SqlBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
interface SqlBuilderInterface
{
    /**
     * @return string
    */
    public function getSQL(): string;





    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;





    /**
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface;





    /**
     * @return ExpressionInterface
    */
    public function expr(): ExpressionInterface;
}
