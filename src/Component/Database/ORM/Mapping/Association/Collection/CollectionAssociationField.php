<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Association\Collection;

use Laventure\Component\Database\ORM\Common\Collection\Contract\CollectionInterface;
use Laventure\Component\Database\ORM\Mapping\Association\AssociatedField;

/**
 * CollectionAssociationField
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data\Metadata\Field
*/
class CollectionAssociationField extends AssociatedField implements CollectionAssociationFieldInterface
{

    /**
     * @param string $name
     * @param CollectionInterface $value
     * @param string $typeName
    */
    public function __construct(
        string $name,
        CollectionInterface $value,
        string $typeName
    )
    {
        parent::__construct($name, $value, $typeName);
    }



    /**
     * @inheritDoc
    */
    public function getCollection(): CollectionInterface
    {
        return $this->value;
    }
}
