<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder;

use Laventure\Component\Database\Query\Builder\QueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;

/**
 * PdoBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Statement
*/
class PdoQueryBuilder extends QueryBuilder
{
    /**
     * @inheritDoc
    */
    public function set($column, $value): static
    {
        return parent::set($column, ":$column")
                      ->setParameter($column, $value);
    }






    /**
     * @inheritdoc
    */
    public function whereIn($column, array $value): static
    {
        $bindParam  = $this->resolveBinding($column);
        return $this->andWhere($this->expr()->in($column, ":$bindParam"))
                    ->setParameter($column, $value);
    }




    /**
     * @inheritdoc
    */
    public function whereEqualTo($column, $value): static
    {
        $bindParam  = $this->resolveBinding($column);
        return $this->andWhere($this->expr()->eq($column, ":$bindParam"))
                    ->setParameter($column, $value);
    }








    /**
     * @param string $column
     * @param $value
     * @param int $index
     * @return $this
    */
    public function setValue(string $column, $value, int $index = 0): static
    {
        return parent::setValue($column, ":$column", $index)
                     ->setParameter($column, $value);
    }





    /**
     * @inheritDoc
    */
    public function addMultipleInsert(array $values): static
    {
        foreach ($values as $position => $attributes) {
            foreach ($attributes as $column => $value) {
                $bindColumn = sprintf('%s_%s', $column, $position);
                $this->insert->setValue($column, ":$bindColumn", $position);
                $this->insert->setParameter($bindColumn, $value);
            }
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addInsert(array $attributes): static
    {
        foreach ($attributes as $column => $value) {
            $this->setValue($column, $value);
        }

        return $this;
    }




    /**
     * @param string $column
     * @return string
    */
    private function resolveBinding(string $column): string
    {
        return str_replace(['.', '-', ' '], ['_'], strtolower($column));
    }
}
