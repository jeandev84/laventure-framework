<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Property\Attribute;

/**
 * PropertyAttribute
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Property
*/
class PropertyAttribute implements PropertyAttributeInterface
{

    /**
     * @param string $propertyName
     * @param object $attribute
    */
    public function __construct(
       protected string $propertyName,
       protected object $attribute
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function getPropertyName(): string
    {
        return $this->propertyName;
    }




    /**
     * @inheritDoc
     */
    public function getAttribute(): object
    {
        return $this->attribute;
    }
}