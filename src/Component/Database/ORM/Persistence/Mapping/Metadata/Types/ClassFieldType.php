<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Types;

use DateTimeInterface;
use Laventure\Component\Database\ORM\Persistence\Collection\Storage\ObjectCollectionInterface;

/**
 * ClassFieldType
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Mapping\Metadata
*/
class ClassFieldType implements ClassFieldTypeInterface
{
    /**
     * @param string $field
     * @param $value
    */
    public function __construct(protected string $field, protected $value)
    {
    }


    /**
     * @inheritDoc
    */
    public function getField(): string
    {
        return $this->field;
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
    public function isDatetime(): bool
    {
        return $this->value instanceof DateTimeInterface;
    }




    /**
     * @inheritDoc
    */
    public function isCollectionAssociate(): bool
    {
        return $this->value instanceof ObjectCollectionInterface;
    }





    /**
     * @inheritDoc
    */
    public function isSingleAssociate(): bool
    {
        return is_object($this->value);
    }





    /**
     * @inheritDoc
    */
    public function isNull(): bool
    {
        return is_null($this->value);
    }





    /**
     * @inheritDoc
    */
    public function isAssociation(): bool
    {
        return ($this->isCollectionAssociate() || $this->isSingleAssociate());
    }
}