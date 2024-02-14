<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types;

use Laventure\Component\Database\Schema\Constraints\Constraint;

/**
 * Index
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types
*/
class Index extends Constraint
{
    /**
     * @param string|null $key
    */
    public function __construct(string $key = null)
    {
        parent::__construct('index', $key);
    }


    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return "INDEX(" . $this->getColumnsAsString() . ")";
    }
}
