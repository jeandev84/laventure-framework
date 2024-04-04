<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Pagination;

use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * Pagination
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Pagination
*/
class Pagination implements PaginationInterface
{

    /**
     * @param QueryBuilderInterface $qb
     * @param int $page
     * @param int $limit
    */
    public function __construct(
        protected QueryBuilderInterface $qb,
        protected int $page,
        protected int $limit
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function getPage(): int
    {
        return $this->page;
    }




    /**
     * @inheritDoc
    */
    public function getPerPage(): int
    {
        return $this->limit;
    }




    /**
     * @inheritDoc
    */
    public function getOffset(): int
    {
        return ($this->limit * abs($this->page - 1));
    }




    /**
     * @inheritDoc
    */
    public function getTotalItems(): int
    {
         return $this->qb->getQuery()
                         ->fetch()
                         ->count();
    }




    /**
     * @inheritDoc
    */
    public function getItems(): array
    {
         return $this->getQuery()
                     ->fetch()
                     ->all();
    }





    /**
     * @inheritDoc
    */
    public function getLastPage(): float
    {
       return ceil($this->getTotalItems() / $this->limit);
    }





    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        return $this->qb->offset($this->getOffset())
                        ->limit($this->getPerPage())
                        ->getQuery();
    }



    /**
     * @inheritDoc
    */
    public function toArray(): array
    {
        return [
           'items'     => $this->getItems(),
           'total'     => $this->getTotalItems(),
           'page'      => $this->getPage(),
           'lastPage'  => $this->getLastPage(),
           'limit'     => $this->getPerPage(),
           'offset'    => $this->getOffset()
        ];
    }
}