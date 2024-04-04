<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql\Schema\Table;

use Laventure\Component\Database\Drivers\Mysql\Schema\Table\Builder\MysqlCreateTableSQLBuilder;
use Laventure\Component\Database\Drivers\Mysql\Schema\Table\Builder\MysqlUpdateTableSQLBuilder;
use Laventure\Component\Database\Schema\Table\Builder\Contract\CreateTableSQLBuilderInterface;
use Laventure\Component\Database\Schema\Table\Builder\Contract\UpdateTableSQLBuilderInterface;
use Laventure\Component\Database\Schema\Table\Builder\TableSQlBuilder;

/**
 * MysqlTableSQLBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table
*/
class MysqlTableSQLBuilder extends TableSQlBuilder
{
    /**
     * @inheritDoc
    */
    public function create(): CreateTableSQLBuilderInterface
    {
        return new MysqlCreateTableSQLBuilder($this->table);
    }




    /**
     * @inheritDoc
    */
    public function update(): UpdateTableSQLBuilderInterface
    {
        return new MysqlUpdateTableSQLBuilder($this->table);
    }
}
