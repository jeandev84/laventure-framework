<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\Types\Association;

use Laventure\Component\Database\ORM\Persistence\Collection\Persistent\PersistentCollectionInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\Types\IdentifierField;

/**
 * CollectionAssociationField
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\DataMapper\Mapping\Metadata\Field
*/
class CollectionAssociationField extends IdentifierField
{
    /**
     * @var PersistentCollectionInterface
    */
    protected PersistentCollectionInterface $persistent;


    /**
     * @param string $fieldName
     * @param $fieldValue
     * @param string $attributeName
     * @param PersistentCollectionInterface $persistent
    */
    public function __construct(
        string $fieldName,
        $fieldValue,
        string $attributeName,
        PersistentCollectionInterface $persistent
    ) {
        parent::__construct($fieldName, $fieldValue, $attributeName);
        $this->persistent = $persistent;
    }




    /**
     * @return PersistentCollectionInterface
    */
    public function getPersistent(): PersistentCollectionInterface
    {
        return $this->persistent;
    }
}
