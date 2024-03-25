<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder\Common;

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
    public function __construct(protected TableInterface $table)
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
         $criteria = [];

         foreach ($this->table->getNewColumns() as $column) {
             $criteria[] = sprintf('%s', $column->getSQL());
         }

         $criteria[] = '';
         $criteria[] = $this->table->getPrimary()->getSQL();

         return join(", ", array_filter($criteria));
    }





    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return $this->getSQL();
    }
}
