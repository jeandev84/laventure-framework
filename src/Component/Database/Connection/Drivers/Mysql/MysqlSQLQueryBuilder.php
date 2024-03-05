<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql;


use Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands\DQL\Select;
use Laventure\Component\Database\Query\Builder\SQL\Common\AbstractSQLQueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;


/**
 * MysqlSQLQueryBuilder
 * Decorator SQL query builder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql
*/
class MysqlSQLQueryBuilder extends AbstractSQLQueryBuilder
{

    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {
        return new Select($this->builder->select($selects));
    }





    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {

    }
}