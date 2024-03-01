<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepositoryInterface;
use Laventure\Component\Database\ORM\UnitOfWork\UnitOfWorkInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * EntityManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Manager
*/
interface EntityManagerInterface extends ObjectManagerInterface
{
    /**
     * @param string $entity
     * @param $id
     * @return object|null
    */
    public function find(string $entity, $id): ?object;




    /**
     * @param string $entity
     * @return EntityRepositoryInterface
    */
    public function getRepository(string $entity): EntityRepositoryInterface;







    /**
     * @param string $entity
     * @return ClassMetadataInterface
    */
    public function getClassMetadata(string $entity): ClassMetadataInterface;








    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;








    /**
     * @return UnitOfWorkInterface
    */
    public function getUnitOfWork(): UnitOfWorkInterface;







    /**
     * @return mixed
    */
    public function createQueryBuilder(): QueryBuilderInterface;







    /**
     * @param string $sql
     * @param array $params
     * @return QueryInterface
    */
    public function createQuery(string $sql, array $params = []): QueryInterface;







    /**
     * Transaction
     *
     * @param callable $func
     *
     * @return mixed
    */
    public function transaction(callable $func): mixed;
}
