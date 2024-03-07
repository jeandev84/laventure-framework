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
     * @param string $fieldName
     * @param $fieldValue
     * @param string $attributeName
    */
    public function __construct(
        protected string $fieldName,
        protected $fieldValue,
        protected string $attributeName
    ) {
    }



    /**
     * @inheritDoc
    */
    public function getFieldName(): string
    {
        return $this->fieldName;
    }



    /**
     * @inheritDoc
    */
    public function getFieldValue(): mixed
    {
        return $this->fieldValue;
    }



    /**
     * @inheritDoc
    */
    public function getAttributeName(): string
    {
        return $this->attributeName;
    }
}
