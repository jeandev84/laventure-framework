<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Contract;

use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\HasConstraintInterface;
use Laventure\Contract\Options\HasOptionInterface;
use Stringable;

/**
 * ColumnInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Contract
*/
interface ColumnInterface extends HasOptionInterface, Stringable
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
     * Add comments
     *
     * @param string $comments
     * @return $this
    */
    public function comments(string $comments): static;









    /**
     * Add collation
     *
     * @param string $collation
     * @return $this
    */
    public function collation(string $collation): static;










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
     * Returns constraints
     *
     * @return string
    */
    public function getConstraints(): string;











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
     * Returns expression out
     *
     * @return string
    */
    public function getSQL(): string;








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
     * Determine if column is unique
     *
     * @return bool
    */
    public function isUnique(): bool;
}
