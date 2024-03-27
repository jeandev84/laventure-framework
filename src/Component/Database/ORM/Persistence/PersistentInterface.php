<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence;

use Laventure\Component\Database\ORM\Persistence\Mapper\Identity\IdentityMapperInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\QueryBuilderInterface;

/**
 * PersistentInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\DataMapper
*/
interface PersistentInterface
{
    /**
     * Find object from database or from identity map
     *
     * @param $id
     * @return mixed
    */
    public function find($id): mixed;







    /**
     * Find object by criteria
     *
     * @param array $criteria
     * @return mixed
    */
    public function findOneBy(array $criteria): mixed;









    /**
     * Add insert data
     *
     * @param array $attributes
     * @return $this
    */
    public function addInsert(array $attributes): static;








    /**
     * Insert data to the table and returns last insert ID
     *
     * @return int
    */
    public function insert(): int;







    /**
     * @param array $attributes
     * @param $id
     * @return static
    */
    public function addUpdate(array $attributes, $id): static;







    /**
     * Update data
     *
     * @return mixed
    */
    public function update(): mixed;









    /**
     * @param $id
     * @return $this
    */
    public function addRemove($id): static;







    /**
     * @param array $criteria
     * @return mixed
    */
    public function delete(array $criteria): mixed;






    /**
     * Delete data
     *
     * @return mixed
    */
    public function remove(): mixed;








    /**
     * Create an instance of  query builder
     *
     * @return QueryBuilderInterface
    */
    public function createQueryBuilder(): QueryBuilderInterface;








    /**
     * Returns class metadata
     *
     * @return ClassMetadataInterface
    */
    public function getClassMetadata(): ClassMetadataInterface;








    /**
     * Returns class name
     *
     * @return string
    */
    public function getClassName(): string;






    /**
     * Returns table name
     *
     * @return string
    */
    public function getTableName(): string;






    /**
     * Returns table alias
     *
     * @return string
    */
    public function getTableAlias(): string;






    /**
     * Returns identity data
     *
     * @param $id    // $id record
     * @return mixed
    */
    public function getIdentity($id): mixed;






    /**
     * @param $id   // $id record
     * @param $data // $data to map
     * @return $this
    */
    public function mapIdentity($id, $data): static;






    /**
     * @param $id  // $id record
     * @return mixed
    */
    public function removeIdentity($id): mixed;
}
