<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary;

use Laventure\Component\Database\Schema\Constraints\Constraint;

/**
 * PrimaryKey
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary
*/
class PrimaryKey extends Constraint
{
    /**
     * @param string|null $key
    */
    public function __construct(string $key = null)
    {
        parent::__construct('primaryKey', $key);
    }


    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return "PRIMARY KEY" . ($this->hasColumns() ? "(". $this->getColumnsAsString() . ")" : '');
    }
}
