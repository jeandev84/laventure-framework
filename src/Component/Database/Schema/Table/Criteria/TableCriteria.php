<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Criteria;

use Laventure\Component\Database\Schema\Table\Table;

/**
 * TableCriteria
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Criteria
*/
class TableCriteria implements TableCriteriaInterface
{
    /**
     * @param Table $table
    */
    public function __construct(protected Table $table)
    {
    }



    /**
     * @inheritDoc
    */
    public function create(): string
    {
        return join(', ', array_filter([
            join(', ', array_values($this->table->columns)),
            join(', ', array_values($this->table->constraints))
        ]));
    }



    /**
     * @inheritDoc
    */
    public function update(): string
    {
        return join(', ', array_filter([
            join(', ', $this->getNewColumns()),
            join(', ', array_values($this->table->dropColumns)),
            join(', ', array_values($this->table->renameColumns))
        ]));
    }




    /**
     * @return array
    */
    protected function getNewColumns(): array
    {
        $resolved = [];

        foreach ($this->table->columns as $column) {
            $resolved[] = $column->add()->getSQL();
        }

        return $resolved;
    }
}
