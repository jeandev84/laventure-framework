<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql\Schema\Table\Builder;

use Laventure\Component\Database\Schema\Table\Builder\Common\UpdateTableSQLBuilder;

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
        return $this->table->alter($this->getCriteria());
    }
}
