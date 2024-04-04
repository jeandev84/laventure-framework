<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Property;

use Laventure\Component\Database\ORM\Mapping\Mapping;

/**
 * PropertyMapping
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Property
*/
class PropertyMapping extends Mapping
{

    /**
     * @inheritDoc
    */
    public function map(): mixed
    {
        $properties = [];

        foreach ($this->class->getProperties() as $property) {
            $properties[$property->getName()] = $property;
        }

        return $properties;
    }
}