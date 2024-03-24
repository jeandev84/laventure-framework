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
    public function getCreateSQL(): string
    {
         $criteria  = join(PHP_EOL, $this->create);
         $tableName = $this->getName();

         return join(PHP_EOL, [
             sprintf('CREATE TABLE IF NOT EXISTS `%s` (', $tableName),
             $criteria,
             ");"
         ]);
    }




    /**
     * @inheritDoc
    */
    public function getUpdateSQL(): string
    {
        return '';
    }




    /**
     * @inheritDoc
     */
    public function getColumn(string $name): ColumnInterface
    {
        // TODO: Implement getColumn() method.
    }

    /**
     * @inheritDoc
     */
    public function getColumns(): array
    {
        // TODO: Implement getColumns() method.
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryKeys(): array
    {
        // TODO: Implement getPrimaryKeys() method.
    }

    /**
     * @inheritDoc
     */
    public function getForeignKey(string $foreignKey): ForeignKeyInterface
    {
        // TODO: Implement getForeignKey() method.
    }

    /**
     * @inheritDoc
     */
    public function getForeignKeys(): array
    {
        // TODO: Implement getForeignKeys() method.
    }

    /**
     * @inheritDoc
     */
    public function dropForeignKeys(): static
    {
        // TODO: Implement dropForeignKeys() method.
    }

    /**
     * @inheritDoc
     */
    public function hasIndex(string $index): bool
    {
        // TODO: Implement hasIndex() method.
    }

    /**
     * @inheritDoc
     */
    public function getIndex(string $index): IndexInterface
    {
        // TODO: Implement getIndex() method.
    }

    /**
     * @inheritDoc
     */
    public function getIndexes(): array
    {
        // TODO: Implement getIndexes() method.
    }

    /**
     * @inheritDoc
     */
    public function hasUniqueKey(string $uniqueKey): bool
    {
        // TODO: Implement hasUniqueKey() method.
    }

    /**
     * @inheritDoc
     */
    public function getUniqueKey(string $uniqueKey): UniqueKeyInterface
    {
        // TODO: Implement getUniqueKey() method.
    }

    /**
     * @inheritDoc
     */
    public function getUniqueKeys(): array
    {
        // TODO: Implement getUniqueKeys() method.
    }

    /**
     * @inheritDoc
     */
    public function getConstraints(): array
    {
        // TODO: Implement getConstraints() method.
    }

    /**
     * @inheritDoc
     */
    public function dump(): mixed
    {
        // TODO: Implement dump() method.
    }

    /**
     * @inheritDoc
     */
    public function create(): mixed
    {
        // TODO: Implement create() method.
    }

    /**
     * @inheritDoc
     */
    public function truncate(): mixed
    {
        // TODO: Implement truncate() method.
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
