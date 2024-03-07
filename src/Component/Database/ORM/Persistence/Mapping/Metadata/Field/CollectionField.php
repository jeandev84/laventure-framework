<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field;

use Laventure\Component\Database\ORM\Persistence\Collection\Persistent\PersistentCollectionInterface;

/**
 * CollectionField
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field
*/
class CollectionField
{
    /**
     * @param string $fieldName
     * @param string $attributeName
     * @param PersistentCollectionInterface $persistent
    */
    public function __construct(
        protected string $fieldName,
        protected string $attributeName,
        protected  PersistentCollectionInterface $persistent
    ) {
    }



    /**
     * @return string
    */
    public function getFieldName(): string
    {
        return $this->fieldName;
    }





    /**
    * @return string
    */
    public function getAttributeName(): string
    {
        return $this->attributeName;
    }


    /**
     * @return PersistentCollectionInterface
    */
    public function getPersistent(): PersistentCollectionInterface
    {
        return $this->persistent;
    }
}
