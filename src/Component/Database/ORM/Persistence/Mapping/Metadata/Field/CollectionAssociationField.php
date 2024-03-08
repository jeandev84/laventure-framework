<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field;

use Laventure\Component\Database\ORM\Persistence\Collection\Persistent\PersistentCollectionInterface;

/**
 * CollectionAssociationField
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field
*/
class CollectionAssociationField extends IdentifierField
{
    /**
     * @inheritDoc
    */
    public function getFieldValue(): PersistentCollectionInterface
    {
        return parent::getFieldValue();
    }
}
