<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Entity;

use ArrayAccess;
use JsonSerializable;
use Laventure\Component\Database\ORM\ActiveRecord\Contract\Timestamps\TimestampsInterface;

/**
 * ActiveRecordEntityInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Entity
*/
interface ActiveRecordEntityInterface extends JsonSerializable, ArrayAccess
{
    /**
     * @param string $column
     * @param $value
     * @return $this
    */
    public function setAttribute(string $column, $value): static;







    /**
     * Set attributes
     *
     * @param array $attributes
     * @return $this
    */
    public function fill(array $attributes): static;






    /**
     * @param string $column
     * @param null $default
     * @return mixed
     */
    public function getAttribute(string $column, $default = null): mixed;







    /**
     * @param string $column
     * @return bool
     */
    public function hasAttribute(string $column): bool;








    /**
     * @param string $column
     * @return mixed
    */
    public function removeAttribute(string $column): static;







    /**
     * Remove all attributes
     *
     * @return $this
    */
    public function removeAttributes(): static;









    /**
     * Returns all attributes
     *
     * @return array
    */
    public function getAttributes(): array;







    /**
     * Returns attributes to save
     *
     * @return array
    */
    public function getAttributesToSave(): array;








    /**
     * Returns attributes to guarded (keep)
     *
     * @return array
    */
    public function getGuardedAttributes(): array;






    /**
     * Returns attributes to hide used for API for example
     *
     * @return array
    */
    public function getHiddenAttributes(): array;







    /**
     * Returns id
     *
     * @return int
    */
    public function getId(): int;






    /**
     * Returns class name
     *
     * @return string
    */
    public function getClassName(): string;






    /**
     * Returns table name
     *
     * @return string
    */
    public function getTableName(): string;







    /**
     * Returns primary key name
     *
     * @return string
    */
    public function getPrimaryKey(): string;
}
