<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Index;

/**
 * NullIndex
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types\Index
 */
class NullIndex extends Index
{
    public function getSQL(): string
    {
        return '';
    }
}
