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
     * @inheritDoc
    */
    public function addColumn(string $name, ColumnType $type, callable $options): static
    {
        $column = $this->createColumn($name, $type, $options);

        $this->criteria->columns[$name] = $column;

        return $this->saveColumn($column);
    }





    /**
     * @inheritDoc
     * @throws NotFoundColumnException
    */
    public function renameColumn(string $name, string $to): static
    {
        return $this->addUpdateTableSQL($this->getColumn($name)->rename($to));
    }





    /**
     * @inheritDoc
     * @throws NotFoundColumnException
    */
    public function modifyColumn(string $name, callable $func): static
    {
        $column = $this->parseColumnOptions($this->getColumn($name), $func)->getColumn();

        return $this->addUpdateTableSQL($column->modify());
    }





    /**
     * @inheritDoc
     * @throws NotFoundColumnException
    */
    public function dropColumn(string $name): static
    {
        return $this->addUpdateTableSQL($this->getColumn($name)->drop());
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

        return $this->addColumn('created_at');
        /*
        return $this->addCreateTableSQL(
            $this->column('created_at')->datetime()->notNull()->getSQL()
        )->addCreateTableSQL(
            $this->column('updated_at')->datetime()->getSQL()
        );
        */
    }






    /**
     * @inheritDoc
    */
    public function addSoftDeletes(): static
    {
        return $this;
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
    public function addForeignKey(
        string $foreignKey,
        callable $func
    ): static {
        $func($foreign = $this->foreignKey($foreignKey));

        return $this->addCreateTableSQL($foreign->getSQL());
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
        $this->exec($this->getCreateTableSQL());

        return $this->exists();
    }





    /**
     * @inheritDoc
    */
    public function update(): mixed
    {
        return $this->exec($this->getUpdateTableSQL());
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
        return join(';', array_filter([
            $this->getCreateTableSQL(),
            $this->getUpdateTableSQL()
        ]));
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
     * @param ColumnInterface $column
     * @return $this
    */
    public function saveColumn(ColumnInterface $column): static
    {
        $this->criteria->columns[$column->getName()] = $column;

        if ($this->exists()) {
            return $this->addUpdateTableSQL($column->add());
        }

        return $this->addCreateTableSQL($column->getSQL());
    }









    /**
     * @inheritDoc
    */
    public function getCriteria(): TableCriteriaInterface
    {
        return $this->criteria;
    }






    /**
     * Returns create SQL
     *
     * @return string
    */
    public function getCreateTableSQL(): string
    {
        return $this->getBuilder()->createTable();
    }






    /**
     * Returns update SQL
     *
     * @return string
    */
    public function getUpdateTableSQL(): string
    {
        return $this->getBuilder()->updateTable();
    }









    /**
     * @param string $sql
     * @return $this
     */
    public function addCreateTableSQL(string $sql): static
    {
        $this->criteria->create[] = $sql;

        return $this;
    }





    /**
     * @param string $sql
     * @return $this
    */
    public function addUpdateTableSQL(string $sql): static
    {
        $this->criteria->update[] = $sql;

        return $this;
    }






    /**
     * @param ColumnInterface $column
     * @param callable $options
     * @return ColumnOptionInterface
     */
    private function parseColumnOptions(
        ColumnInterface $column,
        callable $options
    ): ColumnOptionInterface {
        $option = new ColumnOptions($column);
        $option->call($options);
        return $option;
    }





    /**
     * @param string $name
     * @param ColumnType $type
     * @param callable $options
     * @return ColumnInterface
     */
    private function createColumn(
        string $name,
        ColumnType $type,
        callable $options
    ): ColumnInterface {

        return $this->parseColumnOptions($this->column($name), $options)
                    ->callMethod($type->value)
                    ->getColumn();
    }
}
