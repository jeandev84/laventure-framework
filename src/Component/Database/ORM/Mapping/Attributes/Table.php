<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Attributes;

use Attribute;

/**
 * Table
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Table
*/
#[Attribute(
    Attribute::TARGET_CLASS
)]
class Table
{
    /**
     * @param string $name
     * @param string|null $alias
    */
    public function __construct(
        public string $name,
        public ?string $alias = ''
    )
    {
    }
}