<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints;

use Stringable;

/**
 * ConstraintInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints
*/
interface ConstraintInterface extends Stringable
{
    /**
     * Returns constraint name
     *
     * @return string
    */
    public function getName(): string;




    /**
     * Returns constraint key
     *
     * @return string|null
    */
    public function getKey(): ?string;




    /**
     * Add columns names
     *
     * @param array $columns
     * @return $this
    */
    public function withColumns(array $columns): static;




    /**
     * Add column name
     *
     * @param string $column
     * @return $this
    */
    public function withColumn(string $column): static;





    /**
     * Returns columns constraints
     *
     * @return array
    */
    public function getColumns(): array;





    /**
     * Returns constraint sql expression
     *
     * @return string
    */
    public function getSQL(): string;
}
