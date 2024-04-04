<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint\Column;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;

/**
 * BlueprintColumnInterface
 *
 * @comments Column decorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Blueprint\Column
*/
interface BlueprintColumnInterface
{
    /**
     * @return $this
    */
    public function increment(): static;




    /**
     * Add primary constraint
     *
     * @return $this
    */
    public function primary(): static;






    /**
     * Add unique constraint
     *
     * @return $this
    */
    public function unique(): static;







    /**
     * Set signed column
     *
     * @return $this
    */
    public function signed(): static;







    /**
     * Set unsigned column
     *
     * @return $this
    */
    public function unsigned(): static;







    /**
     * Set data default value
     *
     * @param $value
     * @return $this
    */
    public function default($value): static;







    /**
     * Set nullable column
     *
     * @return $this
    */
    public function nullable(): static;







    /**
     * @return $this
    */
    public function add(): static;







    /**
     * Modify column
     *
     * @return $this
    */
    public function change(): static;






    /**
     * Rename column
     *
     * @param string $to
     * @return $this
    */
    public function rename(string $to): static;






    /**
     * Drop column
     *
     * @return $this
    */
    public function drop(): static;









    /**
     * Returns column name
     *
     * @return string
    */
    public function getName(): string;






    /**
     * Determine if column exist
     *
     * @return bool
    */
    public function exists(): bool;







    /**
     * Determine if column must be to added
     *
     * @return bool
    */
    public function needsToAdd(): bool;







    /**
     * Returns column as string
     *
     * @return string
    */
    public function toString(): string;
}
