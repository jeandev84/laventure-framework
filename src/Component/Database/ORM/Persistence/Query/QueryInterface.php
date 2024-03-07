<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query;


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
      * Fetch Result
      *
      * @return QueryResultInterface
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
}