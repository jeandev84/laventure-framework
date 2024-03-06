<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\ObjectRepositoryInterface;
use Laventure\Component\Database\ORM\UnitOfWork\UnitOfWorkInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * EntityManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Manager
*/
class EntityManager implements EntityManagerInterface
{
    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function getUnitOfWork(): UnitOfWorkInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function createNativeQuery(string $sql, array $params = []): QueryInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function initializeObject(object $object): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function find(string $class, $id): ?object
    {

    }




    /**
     * @inheritDoc
    */
    public function persist(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function remove(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function contains(object $object): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function detach(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function refresh(object $object): void
    {

    }



    /**
     * @inheritDoc
    */
    public function flush(): void
    {

    }



    /**
     * @inheritDoc
    */
    public function clear(): void
    {

    }



    /**
     * @inheritDoc
    */
    public function getRepository(string $entity): ObjectRepositoryInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function getClassMetadata(string $entity): ClassMetadataInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function getMetadataFactory(): mixed
    {

    }






    /**
     * @inheritDoc
    */
    public function transaction(callable $func): mixed
    {

    }
}
