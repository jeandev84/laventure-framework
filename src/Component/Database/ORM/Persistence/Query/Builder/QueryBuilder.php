<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Delete\Delete;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Insert\Insert;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Update\Update;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DQL\Select\Select;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;

/**
 * QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Query
*/
class QueryBuilder implements QueryBuilderInterface
{
    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;




    /**
     * @var SQLQueryBuilderInterface
    */
    protected SQLQueryBuilderInterface $builder;



    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em      = $em;
        $this->builder = $em->createNativeQueryBuilder();
    }




    /**
     * @inheritDoc
    */
    public function select($columns = null): Select
    {
        return new Select(
            $this->em,
            $this->builder->select($columns)
        );
    }





    /**
     * @inheritDoc
    */
    public function insert(string $table, array $attributes): Insert
    {
        return new Insert(
            $this->em,
            $this->builder->insert($table)->values($attributes)
        );
    }






    /**
     * @inheritDoc
    */
    public function update(string $table, array $attributes): Update
    {
        $qb = new Update($this->em, $this->builder->update($table));

        foreach ($attributes as $column => $value) {
            $qb->set($column, $value);
        }

        dd($qb->getSQL());
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): Delete
    {
        return new Delete(
            $this->em,
            $this->builder->delete($table)
        );
    }
}
