<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Field;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use Laventure\Component\Database\ORM\Mapping\Field\Types\ClassFieldType;
use Laventure\Component\Database\ORM\Mapping\Field\Types\ClassFieldTypeInterface;
use Laventure\Component\Database\ORM\Mapping\Resolver\Column\Value\ColumnValueResolver;
use Laventure\Component\Database\ORM\Mapping\Resolver\Column\Value\ColumnValueResolverInterface;


/**
 * ClassField
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data\Metadata\Field
*/
class ClassField implements ClassFieldInterface
{
    /**
     * @param string $name
     * @param $value
     * @param $typeName //type name
    */
    public function __construct(
        protected string $name,
        protected $value,
        protected $typeName
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
     * @throws Exception
    */
    public function setValue($value): static
    {
          if (is_string($value)) {
             $value = $this->resolveValueString($value);
          }

          $this->value = $value;

          return $this;
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
    public function getType(): ClassFieldTypeInterface
    {
        return new ClassFieldType(
            $this->typeName,
            $this->name,
            $this->value
        );
    }





    /**
     * @inheritDoc
    */
    public function getColumnValue(): mixed
    {
        return $this->getColumnValueResolver()->resolve();
    }





    /**
     * @return ColumnValueResolverInterface
    */
    protected function getColumnValueResolver(): ColumnValueResolverInterface
    {
        return new ColumnValueResolver($this->getType());
    }





    /**
     * @param string $value
     * @return DateTimeInterface|mixed
     * @throws Exception
    */
    protected function resolveValueString(string $value): mixed
    {
        $fieldType = $this->getType();

        if ($fieldType->isDatetimeImmutable()) {
            $value = new DateTimeImmutable($value);
        } elseif ($fieldType->isDatetime()) {
            $value = new DateTime($value);
        }

        return $value;
    }
}
