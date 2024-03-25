<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder\Common;

use Laventure\Component\Database\Schema\Table\Builder\Contract\UpdateTableSQLBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * UpdateTableSQLBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Builder\Common
 */
abstract class UpdateTableSQLBuilder implements UpdateTableSQLBuilderInterface
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
    public function getTableName(): string
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
            $criteria[] = sprintf('%s', $column->add());
        }

        return join(", ", $criteria);
    }





    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return $this->getSQL();
    }
}