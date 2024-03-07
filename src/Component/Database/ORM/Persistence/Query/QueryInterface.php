<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query;

use Laventure\Component\Database\Query\Exception\QueryException;
use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * QueryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Query
 */
interface QueryInterface
{
    /**
     * @return string
    */
    public function getSQL(): string;






    /**
     * @return array
    */
    public function getParameters(): array;





    /**
     * Execute query
     *
     * @param null $fetchMode
     * @return mixed
    */
    public function execute($fetchMode = null): mixed;







    /**
     * Returns mapped class
     *
     * @return string|null
    */
    public function getMappedClass(): ?string;







    /**
     * This result will not be managed by entity manager
     *  because it used if you want to implement your custom manager data
     *
     * @return QueryResultInterface
     * @throws QueryException
    */
    public function fetch(): QueryResultInterface;






    /**
     * Returns all results
     *
     * @return array
    */
    public function fetchAll(): array;







    /**
     * Returns one result
     *
     * @return object|null
    */
    public function fetchOne(): ?object;





    /**
     * Returns data as array
     *
     * @return mixed
    */
    public function fetchArray(): mixed;






    /**
     * Returns columns
     *
     * @return array
    */
    public function fetchColumns(): array;








    /**
     * Returns rows count
     *
     * @return int
    */
    public function count(): int;






    /**
     * Returns last insert ID
     *
     * @return int
    */
    public function lastId(): int;
}
