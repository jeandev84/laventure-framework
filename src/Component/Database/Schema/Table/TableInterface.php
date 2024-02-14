<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Schema\Column\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Types\Index;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign\ForeignKey;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary\PrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\Unique;

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
     * Update table
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
     * @return ColumnInterface
    */
    public function increments(string $name): ColumnInterface;





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
     * Add small integer
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function smallInteger(string $name): ColumnInterface;





    /**
     * Add small integer
     *
     * @param string $name
     * @param int $length
     * @return ColumnInterface
    */
    public function varchar(string $name, int $length = 255): ColumnInterface;








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
     * Add timestamps
     *
     * @return $this
    */
    public function addTimestamps(): static;





    /**
     * Add primary key
     *
     * @param PrimaryKey $primaryKey
     * @return PrimaryKey
    */
    public function addPrimaryKey(PrimaryKey $primaryKey): PrimaryKey;






    /**
     * Add foreign keys
     *
     * @param ForeignKey $foreignKey
     * @return ForeignKey
    */
    public function addForeignKey(ForeignKey $foreignKey): ForeignKey;






    /**
     * Add indexes
     *
     * @param Index $index
     * @return Index
    */
    public function addIndex(Index $index): Index;







    /**
     * @param Unique $unique
     * @return Unique
    */
    public function addUnique(Unique $unique): Unique;







    /**
     * @param ConstraintInterface $constraint
     * @return ConstraintInterface
    */
    public function addConstraint(ConstraintInterface $constraint): ConstraintInterface;







    /**
     * Returns table columns
     *
     * @return ColumnInterface[]
    */
    public function getColumns(): array;





    /**
     * Returns columns name
     *
     * @return array
    */
    public function getColumnNames(): array;





    /**
     * Determine if column exist in table
     *
     * @param string $name
     * @return bool
    */
    public function hasColumn(string $name): bool;





    /**
     * Execute SQL
     *
     * @param string $sql
     * @return mixed
    */
    public function exec(string $sql): mixed;
}
