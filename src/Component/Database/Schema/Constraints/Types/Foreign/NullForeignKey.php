<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Foreign;

/**
 * NullForeignKey
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types\Foreign
 */
class NullForeignKey extends ForeignKey
{
    /**
     * @return string
    */
    public function getSQL(): string
    {
        return '';
    }
}
