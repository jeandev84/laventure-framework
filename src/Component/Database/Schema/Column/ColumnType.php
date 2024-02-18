<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column;

use Stringable;

/**
 * ColumnType
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column
*/
class ColumnType implements Stringable
{
    /**
     * @param string $name
     * @param int $length
    */
    public function __construct(
        protected string $name,
        protected int $length = 0
    ) {
    }


    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return ($this->length ? "$this->name($this->length)" : $this->name);
    }
}
