<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Property\Attribute;

use Laventure\Component\Database\ORM\Mapping\Mapping;

/**
 * PropertyAttributeMapping
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Property\Attribute
 */
class PropertyAttributeMapping extends Mapping
{

    /**
     * @inheritDoc
    */
    public function map(): mixed
    {
        $propertyAttributes = [];

        foreach ($this->class->getProperties() as $property) {
            foreach ($property->getAttributes() as $attribute) {
                $propertyAttributes[$attribute->getName()][] = new PropertyAttribute(
                    $property->getName(),
                    $attribute->newInstance()
                );
            }
        }

        return $propertyAttributes;
    }
}