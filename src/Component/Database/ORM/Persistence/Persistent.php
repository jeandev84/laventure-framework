<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence;

use Laventure\Component\Database\ORM\Mapper\IdentityMapperInterface;
use Laventure\Component\Database\ORM\Persistence\Mapper\IdentityMapper;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadata;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\QueryBuilder;

/**
 * Persistent
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence
*/
class Persistent
{
    /**
     * @var QueryBuilder
    */
    protected QueryBuilder $queryBuilder;


    /**
     * @var ClassMetadata
    */
    protected ClassMetadata $classMetadata;



    /**
     * @var IdentityMapperInterface
    */
    protected IdentityMapperInterface $identityMap;




    /**
     * @param QueryBuilder $queryBuilder
     * @param ClassMetadata $classMetadata
    */
    public function __construct(QueryBuilder $queryBuilder, ClassMetadata $classMetadata)
    {
        $this->queryBuilder  = $queryBuilder;
        $this->classMetadata = $classMetadata;
        $this->identityMap   = new IdentityMapper();
    }




    /**
     * Find data by id
     *
     * @param $id
     * @return mixed
    */
    public function find($id): mixed
    {
        return $id;
    }





    /**
     * PgsqlInsertBuilder data
     *
     * @return int
    */
    public function insert(): int
    {

    }




    /**
     * @return mixed
    */
    public function update(): mixed
    {

    }


    public function delete(): mixed
    {

    }


    /**
     * @return IdentityMapperInterface
    */
    public function getIdentityMap(): IdentityMapperInterface
    {
        return $this->identityMap;
    }



    /**
     * @param $id
     * @return string
    */
    public function makeIdentity($id): string
    {

    }
}
