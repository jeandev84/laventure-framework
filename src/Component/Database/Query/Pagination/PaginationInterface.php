<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Pagination;


use Laventure\Component\Database\Query\QueryInterface;

/**
 * PaginationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\DQL\Select
*/
interface PaginationInterface
{


    /**
     * Returns current page
     *
     * @return int
    */
    public function getPage(): int;





    /**
     * Returns max results number per page
     *
     * @return int
    */
    public function getPerPage(): int;





    /**
     * Returns number offset items
     *
     * @return int
    */
    public function getOffset(): int;






    /**
     * Returns count total items
     *
     * @return int
    */
    public function getTotalItems(): int;







    /**
     * @return array
    */
    public function getItems(): array;







    /**
     * Returns last page number
     *
     * @return mixed|int|float
    */
    public function getLastPage(): mixed;






    /**
     * Returns paginated query
     *
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface;






    /**
     * Returns items info
     *
     * @return array
    */
    public function toArray(): array;
}
