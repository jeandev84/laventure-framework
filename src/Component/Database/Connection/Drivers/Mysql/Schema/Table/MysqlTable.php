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
    )
    {
         parent::__construct($connection, $name);
         $this->columnFactory = new MysqlColumnFactory();
    }




    /**
     * @inheritDoc
    */
    public function createColumn(
        string $name,
        string $type,
        array $options = []
    ): ColumnInterface
    {
        return $this->columnFactory->createColumn($name, $type, $options);
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
    public function getBuilder(): TableSQlBuilderInterface
    {
        return new MysqlTableSQLBuilder($this, $this->criteria);
    }






    /**
     * @inheritDoc
     */
    public function increments(string $name): static
    {
        // TODO: Implement increments() method.
    }

    /**
     * @inheritDoc
     */
    public function bigIncrements(string $name): ColumnInterface
    {
        // TODO: Implement bigIncrements() method.
    }

    /**
     * @inheritDoc
     */
    public function integer(string $name, int $length = 11): ColumnInterface
    {
        // TODO: Implement integer() method.
    }

    /**
     * @inheritDoc
     */
    public function smallInteger(string $name): ColumnInterface
    {
        // TODO: Implement smallInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function bigInteger(string $name): ColumnInterface
    {
        // TODO: Implement bigInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumInteger(string $name): ColumnInterface
    {
        // TODO: Implement mediumInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function tinyInteger(string $name): ColumnInterface
    {
        // TODO: Implement tinyInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function string(string $name, int $length = 255): ColumnInterface
    {
        // TODO: Implement string() method.
    }

    /**
     * @inheritDoc
     */
    public function char(string $name, $value): ColumnInterface
    {
        // TODO: Implement char() method.
    }

    /**
     * @inheritDoc
     */
    public function boolean(string $name): ColumnInterface
    {
        // TODO: Implement boolean() method.
    }

    /**
     * @inheritDoc
     */
    public function datetime(string $name): ColumnInterface
    {
        // TODO: Implement datetime() method.
    }

    /**
     * @inheritDoc
     */
    public function time(string $name): ColumnInterface
    {
        // TODO: Implement time() method.
    }

    /**
     * @inheritDoc
     */
    public function timestamp(string $name): ColumnInterface
    {
        // TODO: Implement timestamp() method.
    }

    /**
     * @inheritDoc
     */
    public function binary(string $name): ColumnInterface
    {
        // TODO: Implement binary() method.
    }

    /**
     * @inheritDoc
     */
    public function date(string $name): ColumnInterface
    {
        // TODO: Implement date() method.
    }

    /**
     * @inheritDoc
     */
    public function decimal(string $name, int $precision, int $scale): ColumnInterface
    {
        // TODO: Implement decimal() method.
    }

    /**
     * @inheritDoc
     */
    public function double(string $name, int $precision, int $scale): ColumnInterface
    {
        // TODO: Implement double() method.
    }

    /**
     * @inheritDoc
     */
    public function enum(string $name, array $values): ColumnInterface
    {
        // TODO: Implement enum() method.
    }

    /**
     * @inheritDoc
     */
    public function float(string $name): ColumnInterface
    {
        // TODO: Implement float() method.
    }

    /**
     * @inheritDoc
     */
    public function json(string $name): ColumnInterface
    {
        // TODO: Implement json() method.
    }

    /**
     * @inheritDoc
     */
    public function text(string $name): ColumnInterface
    {
        // TODO: Implement text() method.
    }

    /**
     * @inheritDoc
     */
    public function longText(string $name): ColumnInterface
    {
        // TODO: Implement longText() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumText(string $name): ColumnInterface
    {
        // TODO: Implement mediumText() method.
    }

    /**
     * @inheritDoc
     */
    public function tinyText(string $name): ColumnInterface
    {
        // TODO: Implement tinyText() method.
    }

    /**
     * @inheritDoc
     */
    public function morphs(string $name): ColumnInterface
    {
        // TODO: Implement morphs() method.
    }
}
