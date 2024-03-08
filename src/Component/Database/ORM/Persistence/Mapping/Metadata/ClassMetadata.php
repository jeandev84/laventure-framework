<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata;

use Laventure\Component\Database\ORM\Persistence\Collection\Persistent\PersistentCollection;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Exception\NotFoundClassFieldException;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\ClassField;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\Types\Association\CollectionAssociationField;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\Types\Association\SingleAssociationField;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\Types\IdentifierField;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Resolver\AttributeValueResolver;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Types\ClassFieldType;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Types\ClassFieldTypeInterface;
use Laventure\Utils\Convertor\CamelCase\CamelCaseConvertorTrait;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * ClassMetadata
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Metadata
*/
class ClassMetadata implements ClassMetadataInterface
{
    use CamelCaseConvertorTrait;


    /**
     * @var ReflectionClass
    */
    protected ReflectionClass $class;



    /**
     * @var string
    */
    public string $identifier = 'id';




    /**
     * @var ClassField[]
    */
    public array $fields = [];



    /**
     * @var array
    */
    public array $attributes = [];


    /**
     * @var IdentifierField[]
    */
    public array $identifiers = [];




    /**
     * @var SingleAssociationField[]
    */
    public array $singleAssociates = [];




    /**
     * @var CollectionAssociationField[]
    */
    public array $collectionAssociates = [];



    /**
     * @param string|object $class
     * @throws ReflectionException
    */
    public function __construct(string|object $class)
    {
        $this->class = new ReflectionClass($class);

        if (is_object($class)) {
            $this->fields      = $this->getFieldValues($class);
            $this->identifiers = $this->getIdentifierValues($class);
        }
    }





    /**
     * @param $class
     * @return static
     * @throws ReflectionException
    */
    public static function create($class): static
    {
        return new static($class);
    }





    /**
     * @inheritDoc
    */
    public function setIdentifier(string $identifier): static
    {
        $this->identifier = $identifier;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->class->getName();
    }






    /**
     * @inheritDoc
    */
    public function getReflectionClass(): ReflectionClass
    {
        return $this->class;
    }




    /**
     * @inheritDoc
    */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }




    /**
     * @inheritDoc
    */
    public function isIdentifier($field): bool
    {
        return in_array($field, $this->getIdentifierFieldNames());
    }





    /**
     * @inheritDoc
    */
    public function getIdentifierFieldNames(): array
    {
        return array_keys($this->identifiers);
    }






    /**
     * @inheritDoc
    */
    public function hasField($field): bool
    {
        return in_array($field, $this->getFieldNames());
    }






    /**
     * @inheritDoc
    */
    public function getFieldNames(): array
    {
        return array_keys($this->fields);
    }






    /**
     * @inheritDoc
    */
    public function getTypeOfField($field): ClassFieldTypeInterface
    {
        if (!$this->hasField($field)) {
            throw new NotFoundClassFieldException($field, [
                "Undefined field form class {$this->getName()}"
            ]);
        }

        return new ClassFieldType($field, $this->getFieldValue($field));
    }





    /**
     * @inheritDoc
    */
    public function getFieldValue(string $field): mixed
    {
        if (!isset($this->fields[$field])) {
            return null;
        }

        return $this->fields[$field]->getValue();
    }





    /**
     * @inheritDoc
    */
    public function getIdentifierValue(string $field): mixed
    {
        if (!isset($this->identifiers[$field])) {
            return null;
        }

        return $this->identifiers[$field]->getValue();
    }






    /**
     * @inheritDoc
    */
    public function getId(): mixed
    {
        return $this->getIdentifierValue($this->identifier);
    }







    /**
     * @inheritDoc
    */
    public function isNew(): bool
    {
        return is_null($this->getId());
    }





    /**
     * @inheritDoc
    */
    public function hasAssociation($field): bool
    {
        return $this->isSingleValuedAssociation($field) ||
               $this->isCollectionValuedAssociation($field);
    }






    /**
     * @inheritDoc
    */
    public function isSingleValuedAssociation($field): bool
    {
        return array_key_exists($field, $this->singleAssociates);
    }






    /**
     * @inheritDoc
    */
    public function isCollectionValuedAssociation($field): bool
    {
        return array_key_exists($field, $this->collectionAssociates);
    }





    /**
     * @inheritDoc
    */
    public function getAssociationNames(): array
    {
        return array_filter($this->getFieldNames(), function ($field) {
            return $this->getTypeOfField($field)->isAssociation();
        });
    }





    /**
     * @inheritDoc
    */
    public function getAssociationTargetClass($assocName): mixed
    {
    }




    /**
     * @inheritDoc
    */
    public function isAssociationInverseSide($assocName): mixed
    {
    }






    /**
     * @inheritDoc
    */
    public function getAssociationMappedByTargetField($assocName): mixed
    {
    }




    /**
     * @param $field
     * @return bool
    */
    public function matchIdentifier($field): bool
    {
        return $this->identifier === $field;
    }







    /**
     * @inheritdoc
    */
    public function getFieldValues(object $object): array
    {
        $fieldValues = [];

        foreach ($this->getProperties() as $property) {

            $name         = $property->getName();
            $value        = $property->getValue($object);
            $attribute    = $this->resolveAttribute($name);
            $fieldType    = new ClassFieldType($attribute, $value);
            $resolver     = new AttributeValueResolver($fieldType);

            $fieldValues[$name] = new ClassField($name, $value, $attribute);

            if (!$fieldType->isObject()) {
                $this->attributes[$attribute] = $resolver->resolve();
            }
        }

        return $fieldValues;
    }





    /**
     * @inheritDoc
    */
    public function getIdentifierValues(object $object): array
    {
        $identifierValues = [];

        foreach ($this->getProperties() as $property) {

            $name          = $property->getName();
            $attribute     = $this->resolveAttribute($name);
            $value         = $property->getValue($object);
            $fieldType     = new ClassFieldType($name, $value);

            if ($this->matchIdentifier($name)) {
                $identifierValues[$name] = new IdentifierField($name, $value, $attribute);
            } elseif ($fieldType->isSingleAssociate()) {
                $attribute = "{$attribute}_id";
                $field     =  new SingleAssociationField($name, $value, $attribute);
                $this->singleAssociates[$name] = $field;
                $identifierValues[$name] = $field;
            } elseif ($fieldType->isCollectionAssociate()) {
                $field = new CollectionAssociationField(
                    $name,
                    $value,
                    $attribute,
                    new PersistentCollection($name, $value)
                );
                $this->collectionAssociates[$name] = $field;
                $identifierValues[$name] = $field;
            }
        }

        return $identifierValues;
    }






    /**
     * @return ReflectionProperty[]
    */
    public function getProperties(): array
    {
        return $this->class->getProperties();
    }






    /**
     * @inheritDoc
    */
    public function getAttributes(): array
    {
         return $this->attributes;
    }






    /**
     * @inheritDoc
    */
    public function withoutAttribute($name): static
    {
         unset($this->attributes[$name]);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function withoutAttributes(array $names): static
    {
        foreach ($names as $name) {
            $this->withoutAttribute($name);
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getPersistAttributes(): array
    {
         $this->withoutAttribute($this->identifier);
         return $this->attributes;
    }






    /**
     * @param string $field
     * @return string
    */
    protected function resolveAttribute(string $field): string
    {
        return $this->camelCaseToUnderscore($field);
    }
}
