<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table\Builder;

use Laventure\Component\Database\Schema\Table\Builder\Common\UpdateTableSQLBuilder;
use Laventure\Component\Database\Schema\Table\Expr\AlterTable;

/**
 * MysqlUpdateTableSQLBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table\Builder
*/
class MysqlUpdateTableSQLBuilder extends UpdateTableSQLBuilder
{

    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return strval(new AlterTable($this->getTableName(), [
            $this->getCriteria()
        ]));
    }
}