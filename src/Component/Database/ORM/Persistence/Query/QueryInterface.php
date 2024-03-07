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
      * Returns all result
      *
      * @return mixed
     */
     public function fetchAll(): mixed;





     /**
      * @return mixed
     */
     public function fetchOne(): mixed;





    /**
     * @return mixed
    */
    public function fetchArray(): mixed;






    /**
     * @return array
    */
    public function fetchColumns(): array;
}