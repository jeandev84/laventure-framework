<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types;

use Laventure\Component\Database\Schema\Constraints\Constraint;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;

/**
 * Index
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types
*/
class Index extends Constraint implements IndexInterface
{
    /**
     * @param string|null $key
    */
    public function __construct(array $columns, string $key = null)
    {
        parent::__construct('index', $columns, $key);
    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return "INDEX(" . $this->getColumnsAsString() . ")";
    }
}
