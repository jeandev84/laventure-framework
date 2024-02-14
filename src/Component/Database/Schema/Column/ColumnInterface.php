<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column;

use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Stringable;

/**
 * ColumnInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column
*/
interface ColumnInterface extends Stringable
{
    /**
     * Add constraints nullable
     *
     * @return $this
    */
    public function nullable(): static;






    /**
     * Set column default value
     *
     * @param $value
     * @return $this
    */
    public function default($value): static;







    /**
     * Define column as primary
     *
     * @return $this
    */
    public function primary(): static;







    /**
     * @return $this
    */
    public function unique(): static;





    /**
     * Incremental column
     *
     * @return $this
    */
    public function increment(): static;





    /**
     * Signed column
     *
     * @return $this
    */
    public function signed(): static;





    /**
     * Unsigned column
     *
     * @return $this
    */
    public function unsigned(): static;







    /**
     * @param string $constraints
     * @return $this
    */
    public function constraint(string $constraints): static;






    /**
     * Add constraint
     * @param ConstraintInterface $constraint
     * @return $this
    */
    public function addConstraint(ConstraintInterface $constraint): static;





    /**
     * set constraints
     *
     * @param ConstraintInterface[] $constraints
     * @return $this
    */
    public function addConstraints(array $constraints): static;





    /**
     * Determine type of constraint defined
     *
     * @param string $name
     * @return bool
    */
    public function hasConstraint(string $name): bool;






    /**
     * Add options
     *
     * @param array $options
     * @return $this
    */
    public function options(array $options): static;





    /**
     * Add columns
     *
     * @return static
    */
    public function add(): static;







    /**
     * Change columns
     *
     * @return $this
    */
    public function modify(): static;






    /**
     * Rename column
     *
     * @param string $to
     * @return $this
    */
    public function rename(string $to): static;






    /**
     * @return $this
    */
    public function drop(): static;






    /**
     * Returns name of column
     *
     * @return string
    */
    public function getName(): string;







    /**
     * Returns type of column
     *
     * @return string
    */
    public function getType(): string;







    /**
     * Determine if column is primary key
     *
     * @return bool
    */
    public function isPrimary(): bool;






    /**
     * Determine if column is signed or not
     *
     * @return bool
    */
    public function isSigned(): bool;







    /**
     * Returns constraints of column
     *
     * @return ConstraintInterface[]
    */
    public function getConstraints(): array;








    /**
     * Returns comments of column
     *
     * @return mixed
    */
    public function getComments(): mixed;






    /**
     * Returns table encoding characters
     *
     * @return mixed
    */
    public function getCollation(): mixed;





    /**
     * Returns columns options
     *
     * @return array
    */
    public function getOptions(): array;






    /**
     * @param $id
     * @param $default
     * @return mixed
    */
    public function getOption($id, $default = null): mixed;






    /**
     * Returns expression out
     *
     * @return string
    */
    public function getSQL(): string;
}
