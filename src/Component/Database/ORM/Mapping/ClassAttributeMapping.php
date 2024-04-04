<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping;

/**
 * ClassAttributeMapping
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Class
 */
class ClassAttributeMapping extends Mapping
{

    /**
     * @inheritDoc
    */
    public function map(): array
    {
        $classAttributes = [];

        foreach ($this->class->getAttributes() as $attribute) {
            $classAttributes[$attribute->getName()] = $attribute->newInstance();
        }

        return $classAttributes;
    }
}