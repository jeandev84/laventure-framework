<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query;

use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertSQlBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Resolver\CriteriaResolver;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Resolver\InsertResolver;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Resolver\UpdateResolver;
use Laventure\Component\Database\Query\Builder\AbstractQueryBuilder;

/**
 * PdoBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Query
*/
class QueryBuilder extends AbstractQueryBuilder
{

    /**
     * @param string $column
     * @param $value
     * @return $this
    */
    public function set(string $column, $value): static
    {
         parent::set($column, ":$column");
         return $this->setParameter($column, $value);
    }




    /**
     * @inheritDoc
    */
    protected function resolveMultipleInsert(int $position, array $attributes): static
    {
        foreach ($attributes as $column => $value) {
            $this->setValue($column, ":{$column}_{$position}", $position);
            $this->setParameter("{$column}_{$position}", $value);
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    protected function resolveInsert(array $attributes): static
    {
        foreach ($attributes as $column => $value) {
            $this->setValue($column, ":$column");
            $this->setParameter($column, $value);
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    protected function resolveCriteria(string $column, $value): string
    {
         $expr = $this->expr();

         if (is_array($value)) {
             return strval($expr->in($column, ":$column"));
         }

         return strval($expr->eq($column, ":$column"));
    }
}
