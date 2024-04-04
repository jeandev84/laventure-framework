<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Field;

use Laventure\Component\Database\ORM\Mapping\Attributes\Column;
use Laventure\Component\Database\ORM\Mapping\Identifier\Generator\Traits\identifierGeneratorTrait;
use Laventure\Component\Database\ORM\Mapping\Relationship\Relationship;
use Laventure\Component\Database\ORM\Mapping\Relationship\RelationshipInterface;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;

/**
 * ClassFieldMapping
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Metadata\Field
*/
class ClassFieldMapping implements ClassFieldMappingInterface
{
    use identifierGeneratorTrait;




    /**
     * @param ReflectionClass $class
     * @param $subject
    */
    public function __construct(
        protected ReflectionClass $class,
        protected $subject
    )
    {
    }



    /**
     * @inheritDoc
    */
    public function getSubject(): mixed
    {
        return $this->subject;
    }



    /**
     * @inheritDoc
    */
    public function map(): array
    {
         $fieldValues = [];

         foreach ($this->class->getProperties() as $property) {
             $name                = $property->getName();
             $value               = $this->getValue($property);
             $type                = $property->getType()->getName();
             $field               = new ClassField($name, $value, $type);
             $fieldValues[$name]  = $field;
         }

         return $fieldValues;
    }





    /**
     * @param ReflectionProperty $property
     * @return mixed
    */
    private function getValue(ReflectionProperty $property): mixed
    {
        if (is_object($this->subject)) {
            return $property->getValue($this->subject);
        }

        return null;
    }





    /**
     * @return Column[]
    */
    private function mapColumns(ReflectionProperty $property): array
    {
        $attributes  = $property->getAttributes(Column::class);

        return array_map(function (ReflectionAttribute $attribute) {
            return $attribute->newInstance();
        }, $attributes);
    }




    /**
     * @param ReflectionProperty $property
     * @return RelationshipInterface|null
    */
    private function makeRelationship(ReflectionProperty $property): ?RelationshipInterface
    {
        $relation  = new Relationship();

        foreach (array_keys($relation->relations) as $relationName) {
            $relation->relations[$relationName] =  $this->getRelationship($property, $relationName);
        }

        return $relation;
    }






    /**
     * @param ReflectionProperty $property
     * @param string $relationName
     * @return mixed
    */
    private function getRelationship(
        ReflectionProperty $property,
        string $relationName
    ): mixed
    {
         if (empty($property->getAttributes($relationName)[0])) {
             return null;
         }

         return $property->getAttributes($relationName)[0]->newInstance();
    }
}