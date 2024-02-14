<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Attributes;

use Attribute;

/**
 * Column
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Attributes
 */
#[Attribute]
class Column
{
    /**
     * @param string $name
     * @param string $type
     * @param array $options
    */
    public function __construct(
        public string $name,
        public string $type,
        public array $options = []
    ) {
    }
}
