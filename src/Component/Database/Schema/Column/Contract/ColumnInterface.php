<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Contract;

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
     * Increment column
     *
     * @return $this
     */
    public function increments(): static;





    /**
     * Add big increment
     *
     * @return $this
     */
    public function bigIncrements(): static;







    /**
     * Add integer
     *
     * @param int $length
     * @return $this
     */
    public function integer(int $length = 11): static;






    /**
     * Add column type small integer
     *
     * @return $this
     */
    public function smallInteger(): static;







    /**
     * Add column type big integer
     *
     * @return $this
     */
    public function bigInteger(): static;







    /**
     * Add column type big integer
     *
     * @return $this
     */
    public function mediumInteger(): static;






    /**
     * Add column type tiny integer
     *
     * @return $this
     */
    public function tinyInteger(): static;








    /**
     * Add column type string
     * @param int $length
     * @return $this
     */
    public function string(int $length = 255): static;







    /**
     * Add column type char
     *
     * @param $value
     * @return $this
     */
    public function char($value): static;






    /**
     * Add column type boolean
     *
     * @return $this
     */
    public function boolean(): static;







    /**
     * Add column type datetime
     *
     * @return $this
     */
    public function datetime(): static;









    /**
     * Add column type time
     *
     * @return $this
     */
    public function time(): static;







    /**
     * Add column type timestamp
     *
     * @return $this
     */
    public function timestamp(): static;







    /**
     * Add column type binary
     *
     * @return ColumnInterface
     */
    public function binary(): static;







    /**
     * Add column type date
     *
     * @return $this
     */
    public function date(): static;








    /**
     * Add column type decimal
     *
     * @param int $precision
     *
     * @param int $scale
     *
     * @return $this
     */
    public function decimal(int $precision, int $scale): static;









    /**
     * Add column type double
     *
     *
     * @param int $precision
     *
     * @param int $scale
     *
     * @return $this
     */
    public function double(int $precision, int $scale): static;






    /**
     * Add column type enum
     *
     * @param array $values
     * @return $this
     */
    public function enum(array $values): static;








    /**
     * Add column type float
     *
     * @return $this
     */
    public function float(): static;







    /**
     * Add column type json
     *
     * @return $this
     */
    public function json(): static;








    /**
     * Add column type text
     *
     * @return $this
     */
    public function text(): static;









    /**
     * Add column type long text
     *
     * @return $this
     */
    public function longText(): static;







    /**
     * Add column type medium text
     *
     * @return $this
     */
    public function mediumText(): static;






    /**
     * Add column type tiny text
     *
     * @return  $this
     */
    public function tinyText(): static;








    /**
     * Add column type morphs
     *
     * @return $this
     */
    public function morphs(): static;





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
     * @param $sign
     * @return $this
    */
    public function sign($sign): static;





    /**
     * Set constraint not null
     *
     * @return $this
    */
    public function notNull(): static;






    /**
     * Set default value option
     *
     * @param $value
     * @return $this
    */
    public function defaultValue($value): static;







    /**
     * Add is null option
     *
     * @param $status
     * @return $this
    */
    public function null($status): static;







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
     * @param string $privileges
     * @return $this
    */
    public function privileges(string $privileges): static;






    /**
     * auto increment for example
     *
     * @param string $extra
     * @return $this
    */
    public function extra(string $extra): static;







    /**
     * @param string $key
     * @return $this
    */
    public function key(string $key): static;





    /**
     * Set column options
     *
     * @param array $options
     * @return $this
    */
    public function options(array $options): static;








    /**
     * Determine if given name exists in options
     *
     * @param string $name
     * @return bool
    */
    public function hasOption(string $name): bool;










    /**
     * Set column option
     *
     * @param $id
     * @param $value
     * @return $this
    */
    public function option($id, $value): static;








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
     * @return string
    */
    public function add(): string;








    /**
     * Modify column expression
     *
     * @return string
    */
    public function modify(): string;







    /**
     * Rename column expression
     *
     * @param string $to
     * @return string
    */
    public function rename(string $to): string;








    /**
     * Drop column expression
     *
     * @return string
    */
    public function drop(): string;









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






    /**
     * @return array
    */
    public function getTypeOptions(): array;










    /**
     * @param string $key
     * @return string
    */
    public function getTypeOption(string $key): string;
}
