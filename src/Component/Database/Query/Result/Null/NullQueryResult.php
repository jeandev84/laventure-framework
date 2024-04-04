<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Result\Null;

use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * NullQueryResult
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Result\Null
 */
class NullQueryResult implements QueryResultInterface
{
    /**
     * @inheritDoc
    */
    public function all(int $fetchMode = 0): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function one(int $fetchMode = 0): mixed
    {
        return null;
    }



    /**
     * @inheritDoc
    */
    public function assoc(): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function column(int $column = 0): mixed
    {
        return null;
    }




    /**
     * @inheritDoc
    */
    public function columns(): array
    {
        return [];
    }





    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return 0;
    }



    /**
     * @inheritDoc
    */
    public function first(): mixed
    {
        return null;
    }
}
