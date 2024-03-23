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
interface ColumnInterface extends Stringable
{



    /**
     * Set column type
     *
     * @param string $type
     * @return $this
    */
    public function type(string $type): static;







    /**
     * Add constraints
     *
     * @param string $constraints
     * @return $this
    */
    public function constraints(string $constraints): static;







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
     * Set column options
     *
     * @param array $options
     * @return $this
    */
    public function options(array $options): static;









    /**
     * Set column option
     *
     * @param $id
     * @param $value
     * @return $this
    */
    public function option($id, $value): static;








    /**
     * Increment column
     *
     * @return $this
    */
    public function increment(): static;







    /**
     * Add constraints nullable
     *
     * @return $this
    */
    public function nullable(): static;









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
     * Add new column expression
     *
     * @return $this
    */
    public function add(): static;








    /**
     * Modify column expression
     *
     * @return $this
    */
    public function modify(): static;







    /**
     * Rename column expression
     *
     * @param string $to
     * @return $this
    */
    public function rename(string $to): static;








    /**
     * Drop column expression
     *
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
     * Returns data type of column
     *
     * @return string
    */
    public function getType(): string;








    /**
     * Returns SIGNED or UNSIGNED
     *
     * @return string
    */
    public function getSign(): string;









    /**
     * Returns constraints like NOT NULL, PRIMARY KEY, UNIQUE ...
     *
     * @return string
    */
    public function getConstraint(): string;











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
     * @return array
    */
    public function getOptions(): array;








    /**
     * @param $key
     * @param $default
     * @return mixed
    */
    public function getOption($key, $default = null): mixed;
}
