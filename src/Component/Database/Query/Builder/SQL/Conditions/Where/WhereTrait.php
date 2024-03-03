<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions\Where;

/**
 * WhereBuilderTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions
*/
trait WhereTrait
{
    /**
     * @var array
    */
    public array $wheres = [];


    /**
     * @var array
    */
    public array $andWheres = [];



    /**
     * @var array
    */
    public array $orWheres  = [];



    /**
     * @param string $condition
     * @return $this
    */
    public function where(string $condition): static
    {
        $this->wheres[] = $condition;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function andWhere(string $condition): static
    {
         $this->andWheres[] = $condition;

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function orWhere(string $condition): static
    {
        $this->orWheres[] = $condition;

        return $this;
    }




    /**
     * @return array
    */
    public function getWheres(): array
    {
        return $this->wheres;
    }
}
