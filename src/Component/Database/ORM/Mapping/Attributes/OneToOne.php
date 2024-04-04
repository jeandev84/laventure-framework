<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Attributes;

use Attribute;
use Laventure\Component\Database\ORM\Mapping\Relationship\AssociatedAttribute;

/**
 * OneToOne
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\RelationshipAttribute\Attributes
*/
#[Attribute(
    Attribute::TARGET_PROPERTY
)]
class OneToOne extends AssociatedAttribute
{

    /**
     * @inheritDoc
    */
    public function getReferenceColumn(): string
    {

    }



    /**
     * @inheritDoc
    */
    public function getTargetEntity(): string
    {

    }
}