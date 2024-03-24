<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
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
     * @param string $entity
     * @return $this
    */
    public function addColumnsFromEntity(string $entity): static;





    /**
     * Create column
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function column(string $name): ColumnInterface;





    /**
     * Add new column
     *
     * @param string $name
     * @param ColumnType $type
     * @param callable $options
     * @return $this
    */
    public function addColumn(string $name, ColumnType $type, callable $options): static;









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
     * @param callable $func
     * @return $this
     */
    public function modifyColumn(string $name, callable $func): static;









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
     * Add timestamp created_at, updated_at columns
     *
     * @return $this
    */
    public function addTimestamps(): static;








    /**
     * Add soft deletes timestamp like deleted_at
     *
     * @return $this
    */
    public function addSoftDeletes(): static;









    /**
     * @param string $key
     * @param string $constraint
     * @return $this
    */
    public function addConstraint(string $key, string $constraint): static;









    /**
     * Add primary keys
     *
     * @param array $primaryKeys
     * @return $this
    */
    public function addPrimaryKey(array $primaryKeys): static;









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
     * @param string $foreignKey
     * @return ForeignKeyInterface
    */
    public function foreignKey(string $foreignKey): ForeignKeyInterface;


    
    
    
    
    
    /**
     * Add foreign key
     *
     * @param string $foreignKey
     * @param callable $func
     * @return $this
    */
    public function addForeignKey(
        string $foreignKey,
        callable $func
    ): static;









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
     * Returns all foreignKeys
     *
     * @return ForeignKeyInterface[]
    */
    public function getForeignKeys(): array;









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
     * Drop table
     *
     * @return mixed
    */
    public function drop(): mixed;





    /**
     * Drop table if exists
     *
     * @return mixed
    */
    public function dropIfExists(): mixed;






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
     * Clear table
     *
     * @return void
    */
    public function clear(): void;
}
