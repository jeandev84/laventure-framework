<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder;

use Laventure\Component\Database\Schema\Table\Criteria\TableCriteria;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;
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
    */
    public function __construct(
        protected TableInterface $table
    ) {
    }





    /**
     * Returns table name
     *
     * @return string
    */
    public function getTableName(): string
    {
        return $this->table->getName();
    }






    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return join(';'. PHP_EOL, array_filter([
            $this->create()->getSQL(),
            $this->update()->getSQL()
        ]));
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->getSQL();
    }
}
