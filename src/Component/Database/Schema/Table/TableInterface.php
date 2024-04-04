<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;
use Laventure\Component\Database\Schema\Table\Builder\TableSQlBuilderInterface;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;

/**
 * TableInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table
*/
interface TableInterface
{
    /**
     * Returns table name
     *
     * @return string
    */
    public function getName(): string;






    /**
     * Returns schema table
     *
     * @return string
    */
    public function getSchemaName(): string;







    /**
     * @param array $columns
     * @return $this
    */
    public function addColumns(array $columns): static;







    /**
     * Returns new instance of column
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function column(string $name): ColumnInterface;





    /**
     * Add new column
     *
     * @param ColumnInterface $column
     * @return $this
    */
    public function addNewColumn(ColumnInterface $column): static;





    /**
     * @param string $name
     * @return bool
    */
    public function hasNewColumn(string $name): bool;





    /**
     * Returns new columns
     *
     * @return ColumnInterface[]
    */
    public function getNewColumns(): array;





    /**
     * Add renamed column
     *
     * @param string $newName
     * @param ColumnInterface $column
     * @return $this
    */
    public function addRenameColumn(string $newName, ColumnInterface $column): static;






    /**
     * @param string $name
     * @return bool
    */
    public function hasRenameColumn(string $name): bool;






    /**
     * Returns renamed columns
     *
     * @return ColumnInterface[]
    */
    public function getRenameColumns(): array;







    /**
     * Add modified column
     *
     * @param ColumnInterface $column
     * @return $this
    */
    public function addModifyColumn(ColumnInterface $column): static;






    /**
     * @param string $name
     * @return bool
    */
    public function hasModifyColumn(string $name): bool;






    /**
     * Returns modified columns
     *
     * @return array
    */
    public function getModifyColumns(): array;






    /**
     * @param ColumnInterface $column
     * @return $this
    */
    public function addDropColumn(ColumnInterface $column): static;






    /**
     * @param string $name
     * @return bool
    */
    public function hasDropColumn(string $name): bool;






    /**
     * Returns drop columns
     *
     * @return array
    */
    public function getDropColumns(): array;








    /**
     * Add new column
     *
     * Example:
     *
     *  $table = $connection->table('users')
     *                      ->addColumn('id', ColumnType::BIGINT,  function (Column $column) {
     *                          return $column->increment();
     *                      })
     *                     ->addColumn('username', ColumnType::STRING, function (Column $column) {
     *                          return $column->length(30);
     *                      })
     *                      ->addColumn('email', ColumnType::STRING, function (Column $column) {
     *                          return $column->length(55);
     *                      })
     *                      ->addColumn('password', ColumnType::STRING)
     *                      ->addColumn('active', ColumnType::BOOLEAN)
     *
     * @param string $name
     * @param ColumnType $type
     * @param callable|null $options
     * @return $this
    */
    public function addColumn(string $name, ColumnType $type, callable $options = null): static;









    /**
     * Rename existent column
     *
     * @param string $name
     * @param string $to
     * @return $this
    */
    public function renameColumn(string $name, string $to): static;









    /**
     * Modify column
     *
     * @param string $name
     * @param callable $options
     * @return $this
     */
    public function modifyColumn(string $name, callable $options): static;









    /**
     * Drop column
     *
     * @param string $name
     *
     * @return $this
    */
    public function dropColumn(string $name): static;










    /**
     * Determine if given column name exists
     *
     * @param string $name
     * @return bool
    */
    public function hasColumn(string $name): bool;









    /**
     * Returns column
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function getColumn(string $name): ColumnInterface;










    /**
     * Returns all available columns
     *
     * @return ColumnInterface[]
    */
    public function getColumns(): array;






    /**
     * @return array
    */
    public function getColumnNames(): array;







    /**
     * Add columns type datetime
     *
     * @param string $name
     * @param callable|null $options
     * @return $this
    */
    public function addDatetime(string $name, callable $options = null): static;







    /**
     * Add columns type datetime
     *
     * @param string $name
     * @return $this
    */
    public function addNullableDatetime(string $name): static;





    /**
     * Add timestamp created_at, updated_at columns
     *
     * @return $this
    */
    public function addTimestamps(): static;







    /**
     * Add nullable timestamp
     *
     * @return $this
    */
    public function addNullableTimestamps(): static;







    /**
     * Add soft deletes timestamp like deleted_at
     *
     * @return $this
    */
    public function addSoftDeletes(): static;









    /**
     * Add primary keys
     *
     * @param array $primaryKeys
     * @return $this
    */
    public function addPrimaryKey(array $primaryKeys): static;







    /**
     * @param string $primaryKey
     * @return PrimaryKeyInterface
    */
    public function getPrimaryKey(string $primaryKey): PrimaryKeyInterface;









    /**
     * Determine if given key is primary key
     *
     * @param string $primaryKey
     * @return bool
    */
    public function hasPrimaryKey(string $primaryKey): bool;









    /**
     * Drop primary key
     *
     * @param string $primaryKey
     * @return $this
    */
    public function dropPrimaryKey(string $primaryKey): static;









    /**
     * Drop all primary keys
     *
     * @return $this
    */
    public function dropPrimaryKeys(): static;







    /**
     * Returns primary keys
     *
     * @return array
    */
    public function getPrimaryKeys(): array;





    /**
     * Add foreign key
     *
     * Example:
     *
     *  $table->addForeignKey('book_id', function (ForeignKeyInterface $column) {
     *      return $column->references('id')->on('books')->onDelete();
     *  });
     *
     * @param string $foreignKey
     * @param callable $options
     * @return $this
    */
    public function addForeignKey(string $foreignKey, callable $options): static;









    /**
     * Determine if given key is foreign key
     *
     * @param string $foreignKey
     * @return bool
    */
    public function hasForeignKey(string $foreignKey): bool;









    /**
     * Returns existent foreignKey
     *
     * @param string $foreignKey
     * @return ForeignKeyInterface
    */
    public function getForeignKey(string $foreignKey): ForeignKeyInterface;







    /**
     * Returns new instance of foreignKey
     *
     * Example:
     *  $table->foreign('user_id')->references('id')->on('users')->onDelete()->onUpdate();
     *
     * @param string $foreignKey
     * @return ForeignKeyInterface
    */
    public function foreignKey(string $foreignKey): ForeignKeyInterface;









    /**
     * Returns all foreignKeys
     *
     * @return ForeignKeyInterface[]
    */
    public function getForeignKeys(): array;









    /**
     * @param string $foreignKey
     * @return $this
    */
    public function dropForeignKey(string $foreignKey): static;





    /**
     * Drop foreign keys
     *
     * @return $this
    */
    public function dropForeignKeys(): static;








    /**
     * Add indexes
     *
     * @param array $indexes
     * @return $this
    */
    public function addIndex(array $indexes): static;









    /**
     * Drop indexes
     *
     * @return $this
    */
    public function dropIndexes(): static;






    /**
     * @param string $index
     * @return $this
    */
    public function dropIndex(string $index): static;








    /**
     * Determine if given index name exists
     *
     * @param string $index
     * @return bool
    */
    public function hasIndex(string $index): bool;









    /**
     * Returns index
     *
     * @param string $index
     * @return IndexInterface
    */
    public function getIndex(string $index): IndexInterface;










    /**
     * Returns indexes items
     *
     * @return array
    */
    public function getIndexes(): array;








    /**
     * Add unique keys
     *
     * @param array $uniqueKeys
     * @return $this
    */
    public function addUniqueKey(array $uniqueKeys): static;








    /**
     * Determine if unique key exists
     *
     * @param string $uniqueKey
     * @return bool
    */
    public function hasUniqueKey(string $uniqueKey): bool;









    /**
     * @param string $uniqueKey
     * @return UniqueKeyInterface
    */
    public function getUniqueKey(string $uniqueKey): UniqueKeyInterface;







    /**
     * Returns unique keys
     *
     * @return UniqueKeyInterface[]
    */
    public function getUniqueKeys(): array;








    /**
     * Returns all constraints of table
     *
     * @return ConstraintInterface[]
    */
    public function getConstraints(): array;









    /**
     * Set identifier name
     *
     * @param string $identifier
     * @return $this
    */
    public function setIdentifier(string $identifier): static;








    /**
     * Returns identifier name
     *
     * @return string
    */
    public function getIdentifier(): string;









    /**
     * Insert data to the table
     *
     * @param array $attributes
     * @return $this
    */
    public function insert(array $attributes): static;









    /**
     * Set data to update
     *
     * @param string $column
     * @param mixed $value
     * @return $this
    */
    public function set(string $column, mixed $value): static;









    /**
     * Delete one record of table
     *
     * @param $id
     * @return $this
    */
    public function delete($id): static;









    /**
     * Determine if table exists
     *
     * @return bool
    */
    public function exists(): bool;









    /**
     * Dump table
     *
     * @return mixed
    */
    public function dump(): mixed;









    /**
     * Returns generated SQL
     *
     * @return string
    */
    public function getSQL(): string;










    /**
     * @return TableSQlBuilderInterface
    */
    public function expr(): TableSQlBuilderInterface;









    /**
     * Returns table criteria
     *
     * @return TableCriteriaInterface
    */
    public function getCriteria(): TableCriteriaInterface;









    /**
     * Create a new table
     *
     * @return mixed
    */
    public function create(): mixed;










    /**
     * Rename table
     *
     * @param string $to  #new table name
     * @return mixed
    */
    public function rename(string $to): mixed;








    /**
     * Update table
     *
     * @return mixed
    */
    public function update(): mixed;








    /**
     * Create or Update table
     *
     * @return mixed
    */
    public function save(): mixed;










    /**
     * Drop table if  exists
     *
     * @return mixed
    */
    public function drop(): mixed;








    /**
     * Drop table cascade
     *
     * @return mixed
    */
    public function dropCascade(): mixed;







    /**
     * Truncate table
     *
     * @return mixed
    */
    public function truncate(): mixed;










    /**
     * Truncate table cascade
     *
     * @return mixed
    */
    public function truncateCascade(): mixed;










    /**
     * Returns all available tables
     *
     * @return array
    */
    public function list(): array;








    /**
     * Add big increment
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function bigIncrements(string $name): ColumnInterface;










    /**
     * Add integer
     *
     * @param string $name
     * @param int $length
     * @return ColumnInterface
    */
    public function integer(string $name, int $length = 11): ColumnInterface;







    /**
     * Add column type small integer
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function smallInteger(string $name): ColumnInterface;








    /**
     * Add column type big integer
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function bigInteger(string $name): ColumnInterface;






    /**
     * Add column type big integer
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function mediumInteger(string $name): ColumnInterface;






    /**
     * Add column type tiny integer
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function tinyInteger(string $name): ColumnInterface;







    /**
     * Add column type string
     *
     * @param string $name
     * @param int $length
     * @return ColumnInterface
    */
    public function string(string $name, int $length = 255): ColumnInterface;








    /**
     * Add column type char
     *
     * @param string $name
     * @param $value
     * @return ColumnInterface
    */
    public function char(string $name, $value): ColumnInterface;







    /**
     * Add column type boolean
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function boolean(string $name): ColumnInterface;








    /**
     * Add column type datetime
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function datetime(string $name): ColumnInterface;







    /**
     * Add column type time
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function time(string $name): ColumnInterface;







    /**
     * Add column type timestamp
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function timestamp(string $name): ColumnInterface;







    /**
     * Add column type binary
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function binary(string $name): ColumnInterface;







    /**
     * Add column type date
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function date(string $name): ColumnInterface;







    /**
     * Add column type decimal
     *
     * @param string $name
     * @param int $precision
     * @param int $scale
     * @return ColumnInterface
    */
    public function decimal(string $name, int $precision, int $scale): ColumnInterface;










    /**
     * Add column type double
     *
     *
     * @param string $name
     * @param int $precision
     * @param int $scale
     * @return ColumnInterface
    */
    public function double(string $name, int $precision, int $scale): ColumnInterface;









    /**
     * Add column type enum
     *
     * @param string $name
     * @param array $values
     * @return ColumnInterface
    */
    public function enum(string $name, array $values): ColumnInterface;








    /**
     * Add column type float
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function float(string $name): ColumnInterface;







    /**
     * Add column type json
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function json(string $name): ColumnInterface;






    /**
     * Add column type text
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function text(string $name): ColumnInterface;








    /**
     * Add column type long text
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function longText(string $name): ColumnInterface;







    /**
     * Add column type medium text
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function mediumText(string $name): ColumnInterface;







    /**
     * Add column type tiny text
     *
     * @param string $name
     * @return  ColumnInterface
    */
    public function tinyText(string $name): ColumnInterface;








    /**
     * Add column type morphs
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function morphs(string $name): ColumnInterface;







    /**
     * Add column type default
     *
     * @param $value
     *
     * @return mixed
    */
    public function default($value): static;








    /**
     * Add column type timestamp
     *
     * @return $this
    */
    public function unsigned(): static;







    /**
     * @param string $criteria
     * @return string
    */
    public function alter(string $criteria): string;








    /**
     * Clear table
     *
     * @return void
    */
    public function clear(): void;
}




/*
$table = $connection->table('users')
->addColumn('id', ColumnType::BIGINT,  function (Column $column) {
    return $column->increment();
})
->addColumn('username', ColumnType::STRING, function (Column $column) {
    return $column->length(150);
})
->addColumn('email', ColumnType::STRING, function (Column $column) {
    return $column->length(180);
})
->addColumn('password', ColumnType::STRING)
->addColumn('active', ColumnType::Boolean)
->addTimestamps()
->addSoftDeletes()
->addForeignKey('book_id', function (ForeignKeyInterface $foreignKey) {
    return $foreignKey->references('id')->on('books')->onDelete();
})
->addPrimaryKey(['id'])
->addUniqueKey(['email']);

dump($table->expr()->create()->getSQL());
*/