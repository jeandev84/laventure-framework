<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Result;

/**
 * QueryResultInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Result
*/
interface QueryResultInterface
{
    /**
     * Fetch all result
     *
     * @param int $fetchMode
     * @return array
    */
    public function all(int $fetchMode = 0): array;




    /**
     * Fetch one result
     *
     * @param int $fetchMode
     * @return mixed
    */
    public function one(int $fetchMode = 0): mixed;






    /**
     * Returns first result
     *
     * @return mixed
    */
    public function first(): mixed;








    /**
     * Fetch result as array
     *
     * @return array
    */
    public function assoc(): array;








    /**
     * Fetch column
     *
     * @param int $column
     *
     * @return mixed
    */
    public function column(int $column = 0): mixed;






    /**
     * Fetch all columns
     *
     * @return mixed
    */
    public function columns(): mixed;








    /**
     * Returns rows count
     *
     * @return int
    */
    public function count(): int;
}
