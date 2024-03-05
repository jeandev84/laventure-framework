<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Insert;

/**
 * InsertResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\DML\Insert
*/
class InsertResolver implements InsertResolverInterface
{
    /**
     * @param InsertBuilderInterface $builder
    */
    public function __construct(public InsertBuilderInterface $builder)
    {
    }




    /**
     * @inheritDoc
    */
    public function resolveMultipleInsert(array $values): static
    {
        foreach ($values as $position => $attributes) {
            foreach ($attributes as $column => $value) {
                $this->builder->setValue($column, $value, $position);
            }
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function resolveInsert(array $values): static
    {
        foreach ($values as $column => $value) {
            $this->builder->setValue($column, $value);
        }

        return $this;
    }
}