<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder\Common;

use Laventure\Component\Database\Query\Utils\QueryUtils;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;
use Laventure\Component\Database\Schema\Table\Builder\Contract\CreateTableSQLBuilderInterface;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;
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
    ) {
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
        return QueryUtils::str([
            $this->getNewColumnsSQL(),
            $this->getForeignSQL(),
            $this->getPrimarySQL(),
            $this->getUniqueSQL()
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
        return QueryUtils::str($this->getNewColumnQueries());
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
        return $this->table
                    ->getCriteria()
                    ->getPrimary()
                    ->getSQL();
    }





    /**
     * @return string
    */
    protected function getUniqueSQL(): string
    {
        return $this->table
                    ->getCriteria()
                    ->getUnique()
                    ->getSQL();
    }




    /**
     * @return string
    */
    protected function getForeignSQL(): string
    {
        return QueryUtils::str($this->getForeignQueries());
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
}
