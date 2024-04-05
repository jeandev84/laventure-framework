<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Column\Column;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Exception\ColumnAlreadyExistsException;
use Laventure\Component\Database\Schema\Column\Exception\NotFoundColumnException;
use Laventure\Component\Database\Schema\Column\Factory\ColumnFactoryInterface;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;
use Laventure\Component\Database\Schema\Column\Types\TimestampColumn;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Types\Foreign\ForeignKey;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteria;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;
use Laventure\Component\Database\Schema\Table\Expr\AlterTable;
use Laventure\Contract\Parameter\ParameterInterface;
use Laventure\Utils\Parameter\Parameter;

/**
 * Table
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table
*/
abstract class Table implements TableInterface
{
    /**
     * @var TableCriteria
    */
    protected TableCriteria $criteria;




    /**
     * @param ConnectionInterface $connection
     * @param string $name
    */
    public function __construct(
        protected ConnectionInterface $connection,
        protected string $name
    ) {
        $this->criteria = new TableCriteria();
    }






    /**
     * @return string
    */
    public function getSchemaName(): string
    {
        return $this->connection
                    ->getConfiguration()
                    ->getSchemaName();
    }





    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }




    /**
     * @param string $sql
     * @return mixed
    */
    public function exec(string $sql): mixed
    {
        return $this->connection->exec($sql);
    }





    /**
     * @param string $sql
     * @return QueryInterface
    */
    public function statement(string $sql): QueryInterface
    {
        return $this->connection->statement($sql);
    }







    /**
     * @inheritDoc
    */
    public function addColumns(array $columns): static
    {
        foreach ($columns as $column) {
            [$name, $type, $options] = $column;
            $this->addColumn($name, $type, $options);
        }

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function addNewColumn(ColumnInterface $column): static
    {
        $this->criteria->newColumn[$column->getName()] = $column;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function hasNewColumn(string $name): bool
    {
        return isset($this->criteria->newColumn[$name]);
    }






    /**
     * @inheritDoc
    */
    public function getNewColumns(): array
    {
        return $this->criteria->newColumn;
    }





    /**
     * @inheritDoc
    */
    public function addRenameColumn(string $newName, ColumnInterface $column): static
    {
        $this->criteria->renameColumn[$newName] = $column;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function hasRenameColumn(string $name): bool
    {
        return isset($this->criteria->renameColumn[$name]);
    }





    /**
     * @inheritDoc
    */
    public function getRenameColumns(): array
    {
        return $this->criteria->renameColumn;
    }





    /**
     * @inheritDoc
    */
    public function addModifyColumn(ColumnInterface $column): static
    {
        $this->criteria->modifyColumn[$column->getName()] = $column;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function hasModifyColumn(string $name): bool
    {
        return isset($this->criteria->modifyColumn[$name]);
    }







    /**
     * @inheritDoc
    */
    public function getModifyColumns(): array
    {
        return $this->criteria->modifyColumn;
    }






    /**
     * @inheritDoc
    */
    public function addDropColumn(ColumnInterface $column): static
    {
        $this->criteria->dropColumn[$column->getName()] = $column;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function hasDropColumn(string $name): bool
    {
        return isset($this->criteria->dropColumn[$name]);
    }





    /**
     * @inheritDoc
    */
    public function getDropColumns(): array
    {
        return $this->criteria->dropColumn;
    }





    /**
     * @inheritDoc
    */
    public function getColumnNames(): array
    {
        return array_keys($this->getColumns());
    }





    /**
     * @inheritDoc
    */
    public function addColumn(string $name, ColumnType $type, callable $options = null): static
    {
        $column = $this->column($name);
        $type   = $type->value;

        if (method_exists($column, $type)) {
            call_user_func([$column, $type]);
        }

        if ($options) {
            $options(new Column($column));
        }

        return $this->addNewColumn($column);
    }







    /**
     * @inheritDoc
     * @throws NotFoundColumnException
    */
    public function renameColumn(string $name, string $to): static
    {
        return $this->addRenameColumn($to, $this->getColumn($name));
    }







    /**
     * @inheritDoc
     * @throws NotFoundColumnException
    */
    public function modifyColumn(string $name, callable $options): static
    {
        $column = $this->getColumn($name);
        $options(new Column($column));
        return $this->addModifyColumn($column);
    }





    /**
     * @inheritDoc
     * @throws NotFoundColumnException
    */
    public function dropColumn(string $name): static
    {
        return $this->addDropColumn($this->getColumn($name));
    }







    /**
     * @inheritDoc
    */
    public function hasColumn(string $name): bool
    {
        return array_key_exists($name, $this->getColumns());
    }





    /**
     * @inheritDoc
    */
    public function getColumn(string $name): ColumnInterface
    {
        if (!$this->hasColumn($name)) {
            throw new NotFoundColumnException($name, [
                'context' => get_called_class()
            ]);
        }

        return $this->getColumns()[$name];
    }






    /**
     * @inheritDoc
     */
    public function addDatetime(string $name, callable $options = null): static
    {
        return $this->addColumn($name, ColumnType::DATETIME, $options);
    }






    /**
     * @inheritDoc
     */
    public function addNullableDatetime(string $name): static
    {
        return $this->addDatetime($name, function (Column $option) {
            return $option->nullable();
        });
    }






    /**
     * @inheritDoc
     */
    public function addTimestamps(): static
    {
        return $this->addDatetime(TimestampColumn::createdAt())
                    ->addDatetime(TimestampColumn::deletedAt());
    }






    /**
     * @inheritDoc
     */
    public function addNullableTimestamps(): static
    {
        return $this->addNullableDatetime(TimestampColumn::createdAt())
                    ->addNullableDatetime(TimestampColumn::updatedAt());
    }






    /**
     * @inheritDoc
     */
    public function addSoftDeletes(): static
    {
        return $this->addNullableDatetime(TimestampColumn::deletedAt());
    }








    /**
     * @inheritDoc
    */
    public function addPrimaryKey(array $primaryKeys): static
    {
        $this->criteria->primary = array_merge(
            $this->criteria->primary,
            $primaryKeys
        );

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function hasPrimaryKey(string $primaryKey): bool
    {
        return array_key_exists($primaryKey, $this->getPrimaryKeys());
    }









    /**
     * @inheritDoc
    */
    public function addForeignKey(string $foreignKey, callable $options): static
    {
        $options($foreign = $this->foreignKey($foreignKey));

        $this->criteria->foreign[$foreignKey] = $foreign->getSQL();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function hasForeignKey(string $foreignKey): bool
    {
        return array_key_exists($foreignKey, $this->getForeignKeys());
    }






    /**
     * @inheritDoc
    */
    public function addIndex(array $indexes): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addUniqueKey(array $uniqueKeys): static
    {
        $this->criteria->unique = array_merge(
            $this->criteria->unique,
            $uniqueKeys
        );

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function hasUniqueKey(string $uniqueKey): bool
    {
        return array_key_exists($uniqueKey, $this->getUniqueKeys());
    }






    /**
     * @inheritDoc
    */
    public function rename(string $to): bool|int
    {
        return $this->exec(sql:
            sprintf("ALTER TABLE RENAME %s TO %s", $this->getName(), $to)
        );
    }






    /**
     * @inheritDoc
    */
    public function create(): bool
    {
        $this->exec($this->expr()->create()->getSQL());

        return $this->exists();
    }







    /**
     * @inheritDoc
    */
    public function update(): mixed
    {
        return $this->exec($this->expr()->update()->getSQL());
    }







    /**
     * @inheritDoc
    */
    public function truncate(): mixed
    {
        return $this->exec(
            sprintf('TRUNCATE TABLE %s;', $this->getName())
        );
    }






    /**
     * @inheritDoc
    */
    public function truncateCascade(): mixed
    {
        return $this->exec(
            sprintf('TRUNCATE TABLE CASCADE %s;', $this->getName())
        );
    }





    /**
     * @inheritDoc
    */
    public function drop(): mixed
    {
        return $this->exec(
            sprintf('DROP TABLE %s CASCADE', $this->getName())
        );
    }







    /**
     * @inheritDoc
    */
    public function dropCascade(): mixed
    {
        return $this->exec(
            sprintf('DROP TABLE %s CASCADE', $this->getName())
        );
    }





    /**
     * @inheritDoc
    */
    public function list(): array
    {
        return $this->connection->getDatabase()->getTables();
    }





    /**
     * @inheritDoc
    */
    public function exists(): bool
    {
        return in_array($this->getName(), $this->list());
    }







    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->criteria->clear();
    }







    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->expr()->getSQL();
    }








    /**
     * @inheritDoc
     */
    public function setIdentifier(string $identifier): static
    {
        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getIdentifier(): string
    {

    }







    /**
     * @inheritDoc
    */
    public function insert(array $attributes): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function set(string $column, mixed $value): static
    {
        return $this;
    }





    /**
     * @inheritDoc
     */
    public function delete($id): static
    {
        return $this;
    }








    /**
     * @inheritDoc
    */
    public function save(): mixed
    {

    }








    /**
     * @inheritDoc
    */
    public function getCriteria(): TableCriteriaInterface
    {
        return $this->criteria;
    }





    /**
     * @inheritDoc
     * @throws ColumnAlreadyExistsException
    */
    public function default($value): static
    {
        foreach ($this->criteria->newColumn as $column) {
            $this->addNewColumn($column->default($value));
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function unsigned(): static
    {
        foreach ($this->criteria->newColumn as $column) {
            $this->addNewColumn($column->unsigned());
        }

        return $this;
    }








    /**
     * @inheritDoc
     */
    public function bigIncrements(string $name): ColumnInterface
    {
        $column = $this->column($name)
            ->bigInteger()
            ->increments();

        return $this->criteria->newColumn[$name] = $column;
    }






    /**
     * @inheritDoc
     */
    public function integer(string $name, int $length = 11): ColumnInterface
    {
        $column = $this->column($name)->integer($length);

        return $this->criteria->newColumn[$name] = $column;
    }




    /**
     * @inheritDoc
     */
    public function smallInteger(string $name): ColumnInterface
    {
        $column = $this->column($name)->smallInteger();

        return $this->criteria->newColumn[$name] = $column;
    }




    /**
     * @inheritDoc
     */
    public function bigInteger(string $name): ColumnInterface
    {
        $column = $this->column($name)->bigInteger();

        return $this->criteria->newColumn[$name] = $column;
    }





    /**
     * @inheritDoc
     */
    public function mediumInteger(string $name): ColumnInterface
    {
        $column = $this->column($name)->mediumInteger();

        return $this->criteria->newColumn[$name] = $column;
    }





    /**
     * @inheritDoc
     */
    public function tinyInteger(string $name): ColumnInterface
    {
        $column = $this->column($name)->tinyInteger();

        return $this->criteria->newColumn[$name] = $column;
    }






    /**
     * @inheritDoc
     */
    public function string(string $name, int $length = 255): ColumnInterface
    {
        return $this->column($name)->string($length);
    }





    /**
     * @inheritDoc
    */
    public function char(string $name, $value): ColumnInterface
    {
        return $this->column($name)->char($value);
    }





    /**
     * @inheritDoc
     */
    public function boolean(string $name): ColumnInterface
    {
        return $this->column($name)->boolean();
    }





    /**
     * @inheritDoc
     */
    public function datetime(string $name): ColumnInterface
    {
        return $this->column($name)->datetime();
    }





    /**
     * @inheritDoc
     */
    public function time(string $name): ColumnInterface
    {
        return $this->column($name)->time();
    }





    /**
     * @inheritDoc
     */
    public function timestamp(string $name): ColumnInterface
    {
        return $this->column($name)->timestamp();
    }






    /**
     * @inheritDoc
     */
    public function binary(string $name): ColumnInterface
    {
        return $this->column($name)->binary();
    }






    /**
     * @inheritDoc
     */
    public function date(string $name): ColumnInterface
    {
        return $this->column($name)->date();
    }






    /**
     * @inheritDoc
     */
    public function decimal(string $name, int $precision, int $scale): ColumnInterface
    {
        return $this->column($name)->decimal($precision, $scale);
    }






    /**
     * @inheritDoc
     */
    public function double(string $name, int $precision, int $scale): ColumnInterface
    {
        return $this->column($name)->double($precision, $scale);
    }




    /**
     * @inheritDoc
     */
    public function enum(string $name, array $values): ColumnInterface
    {
        return $this->column($name)->enum($values);
    }






    /**
     * @inheritDoc
     */
    public function float(string $name): ColumnInterface
    {
        return $this->column($name)->float();
    }





    /**
     * @inheritDoc
     */
    public function json(string $name): ColumnInterface
    {
        return $this->column($name)->json();
    }




    /**
     * @inheritDoc
     */
    public function text(string $name): ColumnInterface
    {
        return $this->column($name)->text();
    }




    /**
     * @inheritDoc
     */
    public function longText(string $name): ColumnInterface
    {
        return $this->column($name)->longText();
    }






    /**
     * @inheritDoc
    */
    public function mediumText(string $name): ColumnInterface
    {
        return $this->column($name)->mediumText();
    }




    /**
     * @inheritDoc
    */
    public function tinyText(string $name): ColumnInterface
    {
        return $this->column($name)->tinyText();
    }




    /**
     * @inheritDoc
     */
    public function morphs(string $name): ColumnInterface
    {
        return $this->column($name)->morphs();
    }





    /**
     * @inheritDoc
    */
    public function alter(string $criteria): string
    {
        return strval(new AlterTable($this->getName(), $criteria));
    }








    /**
     * @inheritDoc
    */
    public function column(string $name): ColumnInterface
    {
        return $this->getColumnFactory()->createColumn($name);
    }





    /**
     * @inheritDoc
    */
    public function foreignKey(string $foreignKey): ForeignKeyInterface
    {
        return new ForeignKey($foreignKey);
    }






    /**
     * @param array $data
     * @return ParameterInterface
    */
    protected function param(array $data): ParameterInterface
    {
        return new Parameter($data);
    }






    /**
     * @return ColumnFactoryInterface
    */
    abstract protected function getColumnFactory(): ColumnFactoryInterface;
}



