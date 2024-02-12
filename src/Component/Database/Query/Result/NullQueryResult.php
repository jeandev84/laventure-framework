<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Result;

/**
 * NullQueryResult
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Result
 */
class NullQueryResult implements QueryResultInterface
{
    /**
     * @inheritDoc
    */
    public function all(): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function one(): mixed
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
}
