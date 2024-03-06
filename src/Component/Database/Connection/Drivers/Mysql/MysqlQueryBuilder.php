<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql;


use Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands\DML\MysqlDeleteBuilder;
use Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands\DML\MysqlInsertBuilder;
use Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands\DML\MysqlUpdateBuilder;
use Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands\DQL\MysqlSelectBuilder;
use Laventure\Component\Database\Query\Builder\SQL\Common\AbstractSQLQueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;


/**
 * MysqlQueryBuilder
 * Decorator SQL query builder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql
*/
class MysqlQueryBuilder extends AbstractSQLQueryBuilder
{

    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {
        return new MysqlSelectBuilder($this->builder->select($selects));
    }





    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertBuilderInterface
    {
        return new MysqlInsertBuilder($this->builder->insert($table));
    }




    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {
        return new MysqlUpdateBuilder($this->builder->update($table));
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {
         return new MysqlDeleteBuilder($this->builder->delete($table));
    }
}