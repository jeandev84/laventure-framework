<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table;

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

    public function createTable(): string
    {
        $criteria  = $this->createTableCriteria();
        $tableName = $this->getTableName();

        return join(PHP_EOL, [
            sprintf('CREATE TABLE IF NOT EXISTS `%s` (', $tableName), $criteria, ");"
        ]);
    }



    /**
     * @inheritDoc
     */
    public function getSQL(): string
    {
        // TODO: Implement getSQL() method.
    }



    /**
     * @inheritDoc
     */
    public function create(): CreateTableSQLBuilderInterface
    {
        // TODO: Implement create() method.
    }

    /**
     * @inheritDoc
     */
    public function update(): UpdateTableSQLBuilderInterface
    {
        // TODO: Implement update() method.
    }





    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        // TODO: Implement __toString() method.
    }
}
