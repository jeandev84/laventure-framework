<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field;

/**
 * ClassField
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field
*/
class ClassField implements ClassFieldInterface
{
    /**
     * @param string $name
     * @param $value
     * @param string $attribute
    */
    public function __construct(
        protected string $name,
        protected        $value,
        protected string $attribute
    ) {
    }



    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }



    /**
     * @inheritDoc
    */
    public function getValue(): mixed
    {
        return $this->value;
    }



    /**
     * @inheritDoc
    */
    public function getAttribute(): string
    {
        return $this->attribute;
    }
}
