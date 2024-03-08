<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata;

use Laventure\Component\Database\ORM\Persistence\Collection\Persistent\PersistentCollection;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Exception\NotFoundClassFieldException;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\ClassField;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\Types\Association\CollectionAssociationField;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\Types\Association\SingleAssociationField;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\Types\IdentifierField;
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
     * @param $class
     * @throws ReflectionException
    */
    public function __construct($class)
    {
        $this->class = new ReflectionClass($class);
        $this->mapValues($class);
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
     * @param string $field
     * @return mixed
    */
    public function getFieldValue(string $field): mixed
    {
        if (!isset($this->fields[$field])) {
            return null;
        }

        return $this->fields[$field]->getValue();
    }





    /**
     * @param string $field
     * @return mixed
    */
    public function getIdentifierValue(string $field): mixed
    {
        if (!isset($this->identifiers[$field])) {
            return null;
        }

        return $this->identifiers[$field]->getValue();
    }






    /**
     * Returns identifier value
     *
     * @return mixed
    */
    public function getId(): mixed
    {
        return $this->getIdentifierValue($this->identifier);
    }




    /**
     * @return bool
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
     * @param $class
     * @return void
    */
    private function mapValues($class): void
    {
        if (is_object($class)) {
            $this->fields      = $this->mapFieldValues($class);
            $this->identifiers = $this->getIdentifierValues($class);
        }
    }




    /**
     * @param object $object
     * @return array
    */
    public function mapFieldValues(object $object): array
    {
        $fieldValues = [];

        foreach ($this->getProperties() as $property) {
            $propertyName = $property->getName();
            $fieldValues[$propertyName] = new ClassField(
                $propertyName,
                $property->getValue($object),
                $this->resolveFieldName($propertyName)
            );
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

            $propertyName  = $property->getName();
            $attributeName = $this->resolveFieldName($propertyName);
            $value         = $property->getValue($object);
            $fieldType     = new ClassFieldType($propertyName, $value);

            if ($this->matchIdentifier($propertyName)) {
                $identifierValues[$propertyName] = new IdentifierField(
                    $propertyName,
                    $value,
                    $attributeName
                );
            } elseif ($fieldType->isSingleAssociate()) {
                $field   =  new SingleAssociationField(
                    $propertyName,
                    $value,
        "{$attributeName}_id"
                );
                $this->singleAssociates[$propertyName] = $field;
                $identifierValues[$propertyName] = $field;
            } elseif ($fieldType->isCollectionAssociate()) {
                $field = new CollectionAssociationField(
                    $propertyName,
                    $value,
                    $attributeName,
                    new PersistentCollection($propertyName, $value)
                );
                $this->collectionAssociates[$propertyName] = $field;
                $identifierValues[$propertyName] = $field;
            }
        }

        return $identifierValues;
    }






    /**
     * @return ReflectionProperty[]
    */
    private function getProperties(): array
    {
        return $this->class->getProperties();
    }




    /**
     * @param string $field
     * @return string
    */
    private function resolveFieldName(string $field): string
    {
        return $this->camelCaseToUnderscore($field);
    }
}
