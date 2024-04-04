<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Repository\Contract;

/**
 * ObjectRepositoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Repository
*/
interface ObjectRepositoryInterface
{
    /**
     * Returns one record by given id
     *
     * @param $id
     * @param null $lockMode
     * @param null $lockVersion
     * @return object|null
    */
    public function find($id, $lockMode = null, $lockVersion = null): mixed;






    /**
     * Return one record by given criteria
     *
     * @param array $criteria
     *
     * @param array $orderBy
     *
     * @return object|null
    */
    public function findOneBy(array $criteria, array $orderBy = []): mixed;







    /**
     * Returns all records
     *
     * @return array
    */
    public function findAll(): array;









    /**
     * Returns all records by given criteria
     *
     * @param array $criteria
     *
     * @param array $orderBy
     *
     * @param int|null $limit
     *
     * @param int|null $offset
     *
     * @return object[]
    */
    public function findBy(array $criteria, array $orderBy = [], int $limit = null, int $offset = null): mixed;








    /**
     * Returns class name
     *
     * @return string
    */
    public function getClassName(): string;
}
