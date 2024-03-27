<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Delete;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\BuilderHasConditions;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;

/**
 * Delete
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\DataMapper\Query\Builder\SQL\DML\Delete
*/
class Delete extends BuilderHasConditions
{
    /**
     * @var DeleteBuilderInterface
    */
    protected $builder;



    /**
     * @param EntityManagerInterface $em
     * @param DeleteBuilderInterface $builder
    */
    public function __construct(EntityManagerInterface $em, DeleteBuilderInterface $builder)
    {
        parent::__construct($em, $builder);
    }



    /**
     * @param string $table
     * @return $this
    */
    public function delete(string $table): static
    {
        $this->builder->delete($table);

        return $this;
    }
}
