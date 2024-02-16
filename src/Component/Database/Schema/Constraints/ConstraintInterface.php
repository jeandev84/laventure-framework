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
    public function getType(): string;




    /**
     * Returns constraint key
     *
     * @return string|null
    */
    public function getKey(): ?string;




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
