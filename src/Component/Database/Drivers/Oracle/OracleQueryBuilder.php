<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Oracle;

use Laventure\Component\Database\Drivers\Oracle\Query\Builder\SQL\Commands\DML\OracleDeleteBuilder;
use Laventure\Component\Database\Drivers\Oracle\Query\Builder\SQL\Commands\DML\OracleInsertBuilder;
use Laventure\Component\Database\Drivers\Oracle\Query\Builder\SQL\Commands\DML\OracleUpdateBuilder;
use Laventure\Component\Database\Drivers\Oracle\Query\Builder\SQL\Commands\DQL\OracleSelectBuilder;
use Laventure\Component\Database\Query\Builder\SQL\Common\AbstractSQLQueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;

/**
 * OracleQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers\Oracle
*/
class OracleQueryBuilder extends AbstractSQLQueryBuilder
{

    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {
       return new OracleSelectBuilder($this->builder->select($selects));
    }




    /**
     * @inheritDoc
     */
    public function insert(string $table): InsertBuilderInterface
    {
        return new OracleInsertBuilder($this->builder->insert($table));
    }




    /**
     * @inheritDoc
     */
    public function update(string $table): UpdateBuilderInterface
    {
        return new OracleUpdateBuilder($this->builder->update($table));
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {
        return new OracleDeleteBuilder($this->builder->delete($table));
    }
}