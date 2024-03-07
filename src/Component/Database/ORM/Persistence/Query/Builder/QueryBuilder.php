<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder;


use Laventure\Component\Database\ORM\Persistence\Manager\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Delete\Delete;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Insert\Insert;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Update\Update;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DQL\Select\Select;

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
     * @param EntityManagerInterface $em
    */
    public function __construct(
        protected EntityManagerInterface $em
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function select($columns = null): Select
    {
         return new Select($this->em, $columns);
    }





    /**
     * @inheritDoc
    */
    public function insert(string $table, array $attributes): Insert
    {
        return new Insert($this->em, $table, $attributes);
    }




    /**
     * @inheritDoc
    */
    public function update(string $table, array $attributes): Update
    {
        return new Update($this->em, $table, $attributes);
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): Delete
    {
        return new Delete($this->em, $table);
    }
}
