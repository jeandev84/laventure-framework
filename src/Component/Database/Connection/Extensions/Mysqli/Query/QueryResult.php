<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli\Query;

use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * QueryResult
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\Mysqli\Statement
*/
class QueryResult implements QueryResultInterface
{
    /**
     * @inheritDoc
    */
    public function all(int $fetchMode = 0): array
    {

    }




    /**
     * @inheritDoc
    */
    public function one(int $fetchMode = 0): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function assoc(): array
    {

    }




    /**
     * @inheritDoc
    */
    public function column(int $column = 0): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function columns(): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function count(): int
    {

    }
}
