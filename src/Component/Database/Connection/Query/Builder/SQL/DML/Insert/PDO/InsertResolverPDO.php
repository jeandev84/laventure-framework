<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Insert\PDO;

use Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Insert\InsertResolver;

/**
 * InsertResolverPDO
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\DML\Insert\PDO
*/
class InsertResolverPDO extends InsertResolver
{
    /**
     * @inheritDoc
    */
    public function resolveMultipleInsert(array $values): static
    {
        foreach ($values as $position => $attributes) {
            foreach ($attributes as $column => $value) {
                $this->builder->setValue($column, ":{$column}_{$position}", $position);
                $this->builder->setParameter("{$column}_{$position}", $value);
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
            $this->builder->setValue($column, ":$column");
            $this->builder->setParameter($column, $value);
        }

        return $this;
    }
}