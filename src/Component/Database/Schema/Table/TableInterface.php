<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueInterface;
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
     * Create table
     *
     * @return mixed
    */
    public function create(): mixed;



    /**
     * PgsqlUpdateBuilder table
     *
     * @return mixed
    */
    public function update(): mixed;




    /**
     * Drop table
     *
     * @return mixed
    */
    public function drop(): mixed;




    /**
     * Drop table if exist
     *
     * @return mixed
    */
    public function dropIfExists(): mixed;





    /**
     * Truncate table
     *
     * @return mixed
    */
    public function truncate(): mixed;






    /**
     * @return mixed
    */
    public function truncateCascade(): mixed;





    /**
     * Determine if table exists
     *
     * @return bool
    */
    public function exists(): bool;







    /**
     * List tables
     *
     * @return array
    */
    public function list(): array;







    /**
     * Returns table name
     *
     * @return string
    */
    public function getName(): string;







    /**
     * Add incremental column
     *
     * @param string $name
     * @return $this
    */
    public function increments(string $name): static;





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
     *
     * @return ColumnInterface
    */
    public function bigInteger(string $name): ColumnInterface;





    /**
     * Add column type big integer
     *
     * @param string $name
     *
     * @return ColumnInterface
    */
    public function mediumInteger(string $name): ColumnInterface;






    /**
     * Add column type tiny integer
     *
     * @param string $name
     *
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
     *
     * @return ColumnInterface
    */
    public function boolean(string $name): ColumnInterface;







    /**
     * Add column type datetime
     *
     * @param string $name
     *
     * @return ColumnInterface
    */
    public function datetime(string $name): ColumnInterface;









    /**
     * Add column type time
     *
     * @param string $name
     *
     * @return ColumnInterface
    */
    public function time(string $name): ColumnInterface;







    /**
     * Add column type timestamp
     *
     * @param string $name
     *
     * @return ColumnInterface
    */
    public function timestamp(string $name): ColumnInterface;







    /**
     * Add column type binary
     *
     * @param string $name
     *
     * @return ColumnInterface
    */
    public function binary(string $name): ColumnInterface;







    /**
     * Add column type date
     *
     * @param string $name
     *
     * @return ColumnInterface
    */
    public function date(string $name): ColumnInterface;








    /**
     * Add column type decimal
     *
     * @param string $name
     *
     * @param int $precision
     *
     * @param int $scale
     *
     * @return ColumnInterface
    */
    public function decimal(string $name, int $precision, int $scale): ColumnInterface;









    /**
     * Add column type double
     *
     * @param string $name
     *
     * @param int $precision
     *
     * @param int $scale
     *
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
     *
     * @return ColumnInterface
    */
    public function text(string $name): ColumnInterface;






    /**
     * Add column type long text
     *
     * @param string $name
     *
     * @return ColumnInterface
    */
    public function longText(string $name): ColumnInterface;






    /**
     * Add column type medium text
     *
     * @param string $name
     *
     * @return ColumnInterface
    */
    public function mediumText(string $name): ColumnInterface;






    /**
     * Add column type tiny text
     *
     * @param string $name
     *
     * @return ColumnInterface
    */
    public function tinyText(string $name): ColumnInterface;






    /**
     * Add column type morphs
     *
     * @param string $name
     *
     * @return ColumnInterface
    */
    public function morphs(string $name): ColumnInterface;








    /**
     * Add primary
     *
     * @param array $columns
     * @return static
    */
    public function primary(array $columns): static;







    /**
     * Add unique
     *
     * @param array $columns
     * @return static
    */
    public function unique(array $columns): static;







    /**
     * Add indexes
     *
     * @param array $columns
     * @return static
    */
    public function index(array $columns): static;




    /**
     * Add foreign key
     *
     * @param string $name
     * @return ForeignKeyInterface
    */
    public function foreign(string $name): ForeignKeyInterface;








    /**
     * Add column
     *
     * @param ColumnInterface $column
     * @return ColumnInterface
    */
    public function add(ColumnInterface $column): ColumnInterface;







    /**
     * Add column
     *
     * @param string $name
     * @param string $type
     * @param string $constraints
     * @return ColumnInterface
     */
    public function addColumn(string $name, string $type, string $constraints = ''): ColumnInterface;






    /**
     * Rename column
     *
     * @param string $name
     * @param string $to
     * @return mixed
    */
    public function renameColumn(string $name, string $to): mixed;








    /**
     * @param string $name
     *
     * @return $this
    */
    public function dropColumn(string $name): static;






    /**
     * Returns table columns
     *
     * @return ColumnInterface[]
    */
    public function getColumns(): array;







    /**
     * Determine if column exist in table
     *
     * @param string $name
     * @return bool
    */
    public function hasColumn(string $name): bool;






    /**
     * Returns column names
     *
     * @return array
    */
    public function getColumnNames(): array;





    /**
     * Add primary key
     *
     * @param PrimaryKeyInterface $primaryKey
     * @return PrimaryKeyInterface
    */
    public function addPrimaryKey(PrimaryKeyInterface $primaryKey): PrimaryKeyInterface;






    /**
     * Determine if the given primary key exist
     *
     * @param string $key
     * @return bool
    */
    public function hasPrimaryKey(string $key): bool;






    /**
     * Returns all primary keys
     *
     * @return array
    */
    public function getPrimaryKeys(): array;






    /**
     * Returns all system constraints
     *
     * @return array
    */
    public function listConstraints(): array;






    /**
     * Add foreign keys
     *
     * @param ForeignKeyInterface $foreignKey
     * @return ForeignKeyInterface
    */
    public function addForeignKey(ForeignKeyInterface $foreignKey): ForeignKeyInterface;







    /**
     * Determine if the given foreign key exist
     *
     * @param string $key
     * @return bool
    */
    public function hasForeignKey(string $key): bool;








    /**
     * Returns all foreign keys
     *
     * @return array
    */
    public function getForeignKeys(): array;







    /**
     * Drop foreignKeys
     *
     * @return mixed
    */
    public function dropForeignKeys(): mixed;







    /**
     * Add indexes
     *
     * @param IndexInterface $index
     * @return IndexInterface
    */
    public function addIndex(IndexInterface $index): IndexInterface;







    /**
     * Determine if the given index exist
     *
     * @param string $index
     * @return bool
    */
    public function hasIndex(string $index): bool;






    /**
     * Returns all indexes
     *
     * @return array
    */
    public function getIndexes(): array;








    /**
     * @param UniqueInterface $unique
     * @return UniqueInterface
    */
    public function addUnique(UniqueInterface $unique): UniqueInterface;






    /**
     * Determine if has unique column
     *
     * @param string $name
     * @return bool
    */
    public function hasUnique(string $name): bool;






    /**
     * Returns all uniques columns
     *
     * @return array
    */
    public function getUniques(): array;








    /**
     * Add constraint
     *
     * @param ConstraintInterface $constraint
     * @return ConstraintInterface
    */
    public function addConstraint(ConstraintInterface $constraint): ConstraintInterface;






    /**
     * Determine if given constraint exist
     *
     * @param string $key
     * @return bool
    */
    public function hasConstraint(string $key): bool;





    /**
     * Returns all constraints
     *
     * @param string|null $constraintType
     * @return ConstraintInterface[]
    */
    public function getConstraints(string $constraintType = null): array;








    /**
     * Execute SQL
     *
     * @param string $sql
     * @return mixed
    */
    public function exec(string $sql): mixed;







    /**
     * Create statement
     *
     * @param string $sql
     * @return QueryInterface
    */
    public function statement(string $sql): QueryInterface;






    /**
     * @return TableCriteriaInterface
    */
    public function getCriteria(): TableCriteriaInterface;






    /**
     * Returns schema name
     *
     * @return string
    */
    public function getSchemaName(): string;
}
