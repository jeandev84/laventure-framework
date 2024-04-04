<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Repository;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\Pagination\Pagination;
use Laventure\Component\Database\Query\Pagination\PaginationInterface;

/**
 * ServiceRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Repository
*/
class ServiceEntityRepository extends EntityRepository
{
    /**
     * @param EntityManagerInterface $em
     * @param string $classname
    */
    public function __construct(EntityManagerInterface $em, string $classname)
    {
        parent::__construct($em, $em->getClassMetadata($classname));
    }




    /**
     * @param QueryBuilderInterface $qb
     * @param int|null $page
     * @param int|null $limit
     * @return PaginationInterface
    */
    public function pagination(QueryBuilderInterface $qb, int $page = null, int $limit = null): PaginationInterface
    {
         return new Pagination($qb, $page ?: 1, $limit ?: 10);
    }
}
