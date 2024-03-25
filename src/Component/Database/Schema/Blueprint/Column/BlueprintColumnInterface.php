<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint\Column;

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
     * Modify column
     *
     * @return $this
    */
    public function change(): static;
}
