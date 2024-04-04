<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Attributes;

use Attribute;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;

/**
 * Id
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Attributes
*/
#[Attribute(
    Attribute::TARGET_PROPERTY
)]
class Id extends Column
{
    /**
    */
    public function __construct()
    {
       parent::__construct(type: ColumnType::BIGINT,  options: [
           'increment'    => true,
           'primary'      => true
       ]);
    }
}