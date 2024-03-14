<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Insert;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\Builder;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;

/**
 * Insert
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Mapper\Query\Builder\SQL\DML
*/
class Insert extends Builder
{
    /**
     * @var InsertBuilderInterface
    */
    protected $builder;


    /**
     * @param EntityManagerInterface $em
     * @param InsertBuilderInterface $builder
    */
    public function __construct(EntityManagerInterface $em, InsertBuilderInterface $builder)
    {
        parent::__construct($em, $builder);
    }



    /**
     * @param string $table
     * @return $this
    */
    public function insert(string $table): static
    {
        $this->builder->insert($table);

        return $this;
    }




    /**
     * @param array $values
     * @return $this
    */
    public function values(array $values): static
    {
        $this->builder->values($values);

        return $this;
    }





    /**
     * @param string $column
     * @param $value
     * @param int $index
     * @return $this
    */
    public function setValue(string $column, $value, int $index = 0): static
    {
        $this->builder->setValue($column, $value, $index);

        return $this;
    }
}
