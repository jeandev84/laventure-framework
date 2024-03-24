<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table;

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
    public function updateTable(): string
    {

    }
}
