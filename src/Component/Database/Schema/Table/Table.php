<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Exception\ColumnAlreadyExistsException;
use Laventure\Component\Database\Schema\Column\Exception\NotFoundColumnException;
use Laventure\Component\Database\Schema\Column\Factory\ColumnFactoryInterface;
use Laventure\Component\Database\Schema\Column\Option\ColumnOptions;
use Laventure\Component\Database\Schema\Column\Option\Contract\ColumnOptionInterface;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;
use Laventure\Component\Database\Schema\Column\Types\TimestampColumn;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign\ForeignKey;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteria;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;
use Laventure\Component\Database\Schema\Table\Exception\TableException;
use Laventure\Component\Database\Schema\Table\Expr\AlterTable;
use ReflectionClass;
use ReflectionException;

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
     * @var string
    */
    protected string $schemaName;



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
        $this->schemaName = $this->connection
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
        return $this->connection->executeQuery($sql);
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
     * @throws ReflectionException
    */
    public function addColumnsFromEntity(string $entity): static
    {
        $reflection = new ReflectionClass($entity);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function addNewColumn(ColumnInterface $column): static
    {
        $name = $column->getName();

        if ($this->hasColumn($name)) {
            throw new ColumnAlreadyExistsException(
                $name,
                ['context' => get_called_class()]
            );
        }

        $this->criteria->newColumn[$name] = $column;

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
     * @throws ColumnAlreadyExistsException
    */
    public function addColumn(string $name, string|ColumnType $type, callable $options = null): static
    {
        return $this->addNewColumn($this->createColumn($name, $type, $options));
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
    public function modifyColumn(string $name, callable $func): static
    {
        $column = $this->columnOptions($this->getColumn($name), $func)
                       ->getColumn();


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
        return array_key_exists($name, $this->criteria->columns);
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

        return $this->criteria->columns[$name];
    }






    /**
     * @inheritDoc
     * @throws ColumnAlreadyExistsException
    */
    public function addDatetime(string $name, callable $options = null): static
    {
        return $this->addColumn($name, ColumnType::Datetime, $options);
    }






    /**
     * @inheritDoc
     * @throws ColumnAlreadyExistsException
    */
    public function addNullableDatetime(string $name): static
    {
        return $this->addDatetime($name, function (ColumnOptionInterface $option) {
            return $option->nullable();
        });
    }






    /**
     * @inheritDoc
     * @throws ColumnAlreadyExistsException
    */
    public function addTimestamps(): static
    {
        return $this->addDatetime(TimestampColumn::createdAt())
                    ->addDatetime(TimestampColumn::deletedAt());
    }






    /**
     * @inheritDoc
     * @throws ColumnAlreadyExistsException
    */
    public function addNullableTimestamps(): static
    {
        return $this->addNullableDatetime(TimestampColumn::createdAt())
                    ->addNullableDatetime(TimestampColumn::updatedAt());
    }






    /**
     * @inheritDoc
     * @throws ColumnAlreadyExistsException
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
    public function foreignKey(string $foreignKey): ForeignKeyInterface
    {
        return new ForeignKey($foreignKey);
    }






    /**
     * @inheritDoc
    */
    public function addForeignKey(string $foreignKey, callable $func): static
    {
        $func($foreign = $this->foreignKey($foreignKey));

        $this->criteria->foreign[$foreignKey] = $foreign->getSQL();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function hasForeignKey(string $foreignKey): bool
    {

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
        return $this->exec("ALTER TABLE RENAME $this->name TO $to");
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
    public function drop(): mixed
    {

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
    public function dropIfExists(): mixed
    {

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
     * @throws ColumnAlreadyExistsException
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
    public function getPrimary(): PrimaryKeyInterface
    {
        return $this->criteria->getPrimary();
    }







    /**
     * @inheritDoc
    */
    public function getUnique(): UniqueKeyInterface
    {
        return $this->criteria->getUnique();
    }





    /**
     * @inheritDoc
    */
    public function column(string $name): ColumnInterface
    {
        return $this->getColumnFactory()->createColumn($name);
    }







    /**
     * Parsing column options
     *
     * @param ColumnInterface $column
     * @param callable|null $options
     * @return ColumnOptionInterface
    */
    private function columnOptions(
        ColumnInterface $column,
        callable $options = null
    ): ColumnOptionInterface {
        $option = new ColumnOptions($column);
        $option->call($options ?: $this->defaultOptions());
        return $option;
    }





    /**
     * @param string $name
     * @param string|ColumnType $type
     * @param callable|null $options
     * @return ColumnInterface
    */
    private function createColumn(
        string $name,
        string|ColumnType $type,
        callable $options = null
    ): ColumnInterface {

        $option = $this->columnOptions($this->column($name), $options);

        if ($type instanceof ColumnType) {
            $option->callMethod($type->value);
        } else {
            $option->getColumn()->type($type);
        }

        return $option->getColumn();
    }







    /**
     * @return callable
    */
    private function defaultOptions(): callable
    {
        return function (ColumnOptionInterface $options) {
            return $options->getColumn();
        };
    }






    /**
     * @return ColumnFactoryInterface
    */
    abstract protected function getColumnFactory(): ColumnFactoryInterface;
}
