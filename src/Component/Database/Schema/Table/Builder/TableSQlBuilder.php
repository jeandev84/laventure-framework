<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder;

use Laventure\Component\Database\Schema\Table\Criteria\TableCriteria;
use Laventure\Component\Database\Schema\Table\Table;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * TableSQlBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Criteria
*/
abstract class TableSQlBuilder implements TableSQlBuilderInterface
{
    /**
     * @param TableInterface $table
     * @param TableCriteria $criteria
    */
    public function __construct(
        protected TableInterface $table,
        protected TableCriteria $criteria
    ) {
    }





    /**
     * Returns table name
     *
     * @return string
    */
    protected function getTableName(): string
    {
        return $this->table->getName();
    }






    /**
     * Returns create table criteria
     *
     * @return string
    */
    protected function createTableCriteria(): string
    {
        return join(PHP_EOL, $this->criteria->create);
    }
}
