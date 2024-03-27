<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Drivers\Pgsql\Query\Builder;

use Laventure\Component\Database\Query\Builder\SQL\Common\AbstractSQLQueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Foundation\Database\Drivers\Pgsql\Query\Builder\SQL\Commands\DML\PgsqlDeleteBuilder;
use Laventure\Foundation\Database\Drivers\Pgsql\Query\Builder\SQL\Commands\DML\PgsqlInsertBuilder;
use Laventure\Foundation\Database\Drivers\Pgsql\Query\Builder\SQL\Commands\DML\PgsqlUpdateBuilder;
use Laventure\Foundation\Database\Drivers\Pgsql\Query\Builder\SQL\Commands\DQL\PgsqlSelectBuilder;

/**
 * PgsqlQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Pgsql
*/
class PgsqlQueryBuilder extends AbstractSQLQueryBuilder
{
    /**
     * @inheritDoc
     */
    public function select(string $selects = null): SelectBuilderInterface
    {
        return new PgsqlSelectBuilder($this->builder->select($selects));
    }




    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertBuilderInterface
    {
        return new PgsqlInsertBuilder($this->builder->insert($table));
    }




    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {
        return new PgsqlUpdateBuilder($this->builder->update($table));
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {
        return new PgsqlDeleteBuilder($this->builder->delete($table));
    }
}
