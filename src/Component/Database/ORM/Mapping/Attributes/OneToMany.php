<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Attributes;

use Attribute;
use Laventure\Component\Database\ORM\Mapping\Relationship\AssociatedAttribute;

/**
 * OneToMany
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\RelationshipAttribute
 */
#[Attribute(
    Attribute::TARGET_PROPERTY
)]
class OneToMany extends AssociatedAttribute
{


    /**
     * @param string $targetEntity
     * @param string|null $mappedBy
     * @param string|null $referenceColumn
     * @param array $cascade
    */
    public function __construct(
        string $targetEntity,
        ?string $mappedBy = null,
        ?string $referenceColumn = null,
        array $cascade = []
    )
    {
        parent::__construct($targetEntity, $referenceColumn, $cascade);
        $this->setAssociatedTable($mappedBy);
    }
}