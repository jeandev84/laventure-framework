<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Sqlite;

use Laventure\Component\Database\Connection\Drivers\Sqlite\Query\Builder\SQL\Commands\DML\SqliteDeleteBuilder;
use Laventure\Component\Database\Connection\Drivers\Sqlite\Query\Builder\SQL\Commands\DML\SqliteInsertBuilder;
use Laventure\Component\Database\Connection\Drivers\Sqlite\Query\Builder\SQL\Commands\DML\SqliteUpdateBuilder;
use Laventure\Component\Database\Connection\Drivers\Sqlite\Query\Builder\SQL\Commands\DQL\SqliteSelectBuilder;
use Laventure\Component\Database\Query\Builder\SQL\Common\AbstractSQLQueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;

/**
 * SqliteQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Sqlite
*/
class SqliteQueryBuilder extends AbstractSQLQueryBuilder
{
    /**
     * @inheritDoc
     */
    public function select(string $selects = null): SelectBuilderInterface
    {
        return new SqliteSelectBuilder($this->builder->select($selects));
    }




    /**
     * @inheritDoc
     */
    public function insert(string $table): InsertBuilderInterface
    {
        return new SqliteInsertBuilder($this->builder->insert($table));
    }




    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {
        return new SqliteUpdateBuilder($this->builder->update($table));
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {
        return new SqliteDeleteBuilder($this->builder->delete($table));
    }
}
