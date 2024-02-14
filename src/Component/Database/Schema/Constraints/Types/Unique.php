<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types;

use Laventure\Component\Database\Schema\Constraints\Constraint;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueInterface;

/**
 * Unique
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types
*/
class Unique extends Constraint implements UniqueInterface
{
    /**
     * @param array $columns
     * @param string|null $key
    */
    public function __construct(array $columns = [], string $key = null)
    {
        parent::__construct('unique', $key);
        $this->withColumns($columns);
    }


    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return "UNIQUE" . ($this->hasColumns() ? "(". $this->getColumnsAsString() . ")" : '');
    }
}
