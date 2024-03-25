<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Exception\NotFoundColumnException;
use Laventure\Component\Database\Schema\Column\Option\ColumnOptions;
use Laventure\Component\Database\Schema\Column\Option\Contract\ColumnOptionInterface;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteria;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;
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
    */
    public function getName(): string
    {
        return $this->name;
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
     * @param ColumnInterface $column
     * @return $this
    */
    public function saveColumn(ColumnInterface $column): static
    {
        if ($this->exists()) {
            $this->criteria->update[] = $column->add();
        } else {
            $this->criteria->create[] = $column->getSQL();
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addColumn(string $name, string|ColumnType $type, callable $options = null): static
    {
        $column = $this->createColumn($name, $type, $options);

        $this->criteria->addColumn[$name] = $column;

        return $this->saveColumn($column);
    }





    /**
     * @inheritDoc
     * @throws NotFoundColumnException
    */
    public function renameColumn(string $name, string $to): static
    {
        $column = $this->getColumn($name);
        $this->criteria->renameColumn[$name] = $column;
        $this->criteria->update[]            = $column->rename($to);

        return $this;
    }





    /**
     * @inheritDoc
     * @throws NotFoundColumnException
    */
    public function modifyColumn(string $name, callable $func): static
    {
        $column = $this->parseColumnOptions($this->getColumn($name), $func)
                       ->getColumn();

        $this->criteria->modifyColumn[$name] = $column;
        $this->criteria->update[]            = $column->modify();

        return $this;
    }





    /**
     * @inheritDoc
     * @throws NotFoundColumnException
    */
    public function dropColumn(string $name): static
    {
        $column = $this->getColumn($name);
        $this->criteria->dropColumn[$name] = $column;
        $this->criteria->update[]          = $column->drop();

        return $this;
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
    public function addTimestamps(): static
    {
        $this->datetime('created_at');
        $this->datetime('updated_at');

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function addSoftDeletes(): static
    {
        return $this->datetime('deleted_at', true);
    }







    /**
     * @inheritDoc
    */
    public function addConstraint(string $key, string $constraint): static
    {

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
    public function dropPrimaryKey(string $primaryKey): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function dropPrimaryKeys(): static
    {
        return $this;
    }







    /**
     * @inheritDoc
    */
    public function addForeignKey(string $foreignKey, callable $func): static {

        $func($foreign = $this->foreignKey($foreignKey));

        return $this->addCreateTable($foreign->getSQL());
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
        return $this;
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
        return $this->connection
                    ->getDatabase()
                    ->getTables();
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
     * @param ColumnInterface $column
     * @param callable|null $options
     * @return ColumnOptionInterface
    */
    private function parseColumnOptions(
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

        $option = $this->parseColumnOptions($this->column($name), $options);

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
}
