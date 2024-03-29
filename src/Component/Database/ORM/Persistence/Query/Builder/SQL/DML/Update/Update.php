<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Update;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\BuilderHasConditions;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;

/**
 * Update
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\DataMapper\Query\Builder\SQL\DML\Update
*/
class Update extends BuilderHasConditions
{
    /**
     * @var UpdateBuilderInterface
    */
    protected $builder;





    /**
     * @param EntityManagerInterface $em
     * @param UpdateBuilderInterface $builder
    */
    public function __construct(
        EntityManagerInterface $em,
        UpdateBuilderInterface $builder
    ) {
        parent::__construct($em, $builder);
    }





    /**
     * @param string $table
     * @return $this
    */
    public function update(string $table): static
    {
        $this->builder->update($table);

        return $this;
    }






    /**
     * @param $column
     * @param $value
     * @return $this
    */
    public function set($column, $value): static
    {
        $this->builder->set($column, $value);

        return $this;
    }
}
