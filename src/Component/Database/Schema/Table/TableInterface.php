<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Schema\Column\ColumnInterface;

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
     * Add foreign keys
     *
     * @param $foreignKey
     * @return $this
    */
    public function addForeignKey($foreignKey): static;






    /**
     * Add indexes
     *
     * @param $index
     * @return $this
    */
    public function addIndex($index): static;







    /**
     * @param $constraint
     * @return $this
    */
    public function addConstraint($constraint): static;







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
}
