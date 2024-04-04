<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Attributes;

use Attribute;
use Laventure\Component\Database\ORM\Mapping\Relationship\AssociatedAttribute;

/**
 * ManyToOne
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
class ManyToOne extends AssociatedAttribute
{


      /**
       * @param string|null $inversedBy
       * @param string|null $targetEntity
       * @param string|null $referenceColumn
       * @param array $cascade
      */
      public function __construct(
          ?string $inversedBy,
          ?string $targetEntity = null,
          ?string $referenceColumn = null,
          array $cascade = []
      )
      {
          parent::__construct($targetEntity, $referenceColumn, $cascade);
          $this->setAssociatedTable($inversedBy);
      }
}