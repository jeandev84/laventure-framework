<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table\Column\MysqlColumnFactory;
use Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table\Column\MysqlColumnInfo;
use Laventure\Component\Database\Query\Result\QueryResultInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\Constraint;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Info\ConstraintInfo;
use Laventure\Component\Database\Schema\Constraints\Types\Index;
use Laventure\Component\Database\Schema\Table\Builder\TableSQlBuilderInterface;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;
use Laventure\Component\Database\Schema\Table\Table;

/**
 * MysqlTable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table
*/
class MysqlTable extends Table
{
    /**
     * @var MysqlColumnFactory
    */
    protected MysqlColumnFactory $columnFactory;


    /**
     * @param ConnectionInterface $connection
     * @param string $name
    */
    public function __construct(
        ConnectionInterface $connection,
        string $name
    ) {
        parent::__construct($connection, $name);
        $this->columnFactory = new MysqlColumnFactory();
    }




    /**
     * @inheritDoc
    */
    public function column(string $name): ColumnInterface {
        return $this->columnFactory->createColumn($name);
    }





    /**
     * @inheritDoc
    */
    public function getColumn(string $name): ColumnInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function getColumns(): array
    {

    }





    /**
     * @inheritDoc
    */
    public function getPrimaryKeys(): array
    {

    }





    /**
     * @inheritDoc
    */
    public function getForeignKey(string $foreignKey): ForeignKeyInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function getForeignKeys(): array
    {

    }





    /**
     * @inheritDoc
    */
    public function dropForeignKeys(): static
    {

    }




    /**
     * @inheritDoc
    */
    public function hasIndex(string $index): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function getIndex(string $index): IndexInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function getIndexes(): array
    {

    }





    /**
     * @inheritDoc
    */
    public function hasUniqueKey(string $uniqueKey): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function getUniqueKey(string $uniqueKey): UniqueKeyInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function getUniqueKeys(): array
    {

    }




    /**
     * @inheritDoc
    */
    public function getConstraints(): array
    {

    }




    /**
     * @inheritDoc
    */
    public function dump(): mixed
    {

    }





    /**
     * @inheritDoc
    */
    public function expr(): TableSQlBuilderInterface
    {
        return new MysqlTableSQLBuilder($this, $this->criteria);
    }

    
    
    
    
    
    /**
     * @inheritDoc
    */
    public function foreignKey(string $foreignKey): ForeignKeyInterface
    {
        
    }
}
