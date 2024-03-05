<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepositoryInterface;
use Laventure\Component\Database\ORM\UnitOfWork\UnitOfWorkInterface;
use Laventure\Component\Database\Query\Builder\SQLQueryBuilderInterface;
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
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;








    /**
     * @return UnitOfWorkInterface
    */
    public function getUnitOfWork(): UnitOfWorkInterface;







    /**
     * @return SQLQueryBuilderInterface
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface;







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
