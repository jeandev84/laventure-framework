<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Unique;

/**
 * NullUniqueKey
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types\Unique
 */
class NullUniqueKey extends UniqueKey
{
    public function getSQL(): string
    {
        return '';
    }
}
