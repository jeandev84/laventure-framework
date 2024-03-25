<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder\Common;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Table\Builder\Contract\CreateTableSQLBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * CreateTableSQLBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Builder\Common
*/
abstract class CreateTableSQLBuilder implements CreateTableSQLBuilderInterface
{

    /**
     * @param TableInterface $table
    */
    public function __construct(
        protected TableInterface $table
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function getTable(): string
    {
        return $this->table->getName();
    }




    /**
     * @inheritDoc
    */
    public function getCriteria(): string
    {
         return $this->toStringQueries([
             $this->getNewColumnsSQL(),
             $this->getForeignSQL(),
             $this->getPrimarySQL()
         ]);
    }







    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return $this->getSQL();
    }





    /**
     * @return string
    */
    protected function getNewColumnsSQL(): string
    {
        return $this->toStringQueries($this->getNewColumnQueries());
    }






    /**
     * @return array
    */
    protected function getNewColumnQueries(): array
    {
        return array_map(function (ColumnInterface $column) {
            return sprintf('%s', $column->getSQL());
        }, $this->table->getNewColumns());
    }






    /**
     * @return string
    */
    protected function getPrimarySQL(): string
    {
        return $this->table->getPrimary()->getSQL();
    }






    /**
     * @return string
    */
    protected function getForeignSQL(): string
    {
        return $this->toStringQueries($this->getForeignQueries());
    }





    /**
     * @return array
    */
    protected function getForeignQueries(): array
    {
        return array_values(
            $this->table->getCriteria()->getForeign()
        );
    }





    /**
     * @param array $queries
     * @param string|null $separator
     * @return string
    */
    private function toStringQueries(array $queries, string $separator = null): string
    {
        return join($separator ?: ', ', array_filter($queries));
    }
}
