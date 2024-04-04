<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping;

use Attribute;
use DateTime;
use DateTimeImmutable;
use Exception;
use Laventure\Component\Database\ORM\Mapping\Association\AssociatedFieldInterface;
use Laventure\Component\Database\ORM\Mapping\Association\Collection\CollectionAssociationFieldInterface;
use Laventure\Component\Database\ORM\Mapping\Association\Single\SingleAssociationField;
use Laventure\Component\Database\ORM\Mapping\Association\Single\SingleAssociationFieldInterface;
use Laventure\Component\Database\ORM\Mapping\Attributes\Column;
use Laventure\Component\Database\ORM\Mapping\Attributes\Id;
use Laventure\Component\Database\ORM\Mapping\Attributes\Table;
use Laventure\Component\Database\ORM\Mapping\Exception\ClassMetadataException;
use Laventure\Component\Database\ORM\Mapping\Field\ClassField;
use Laventure\Component\Database\ORM\Mapping\Field\ClassFieldInterface;
use Laventure\Component\Database\ORM\Mapping\Field\ClassFieldMapping;
use Laventure\Component\Database\ORM\Mapping\Field\Exception\NotFoundClassFieldException;
use Laventure\Component\Database\ORM\Mapping\Field\Types\ClassFieldTypeInterface;
use Laventure\Component\Database\ORM\Mapping\Identifier\Exception\NotFoundIdentifierException;
use Laventure\Component\Database\ORM\Mapping\Identifier\Generator\Traits\identifierGeneratorTrait;
use Laventure\Component\Database\ORM\Mapping\Identifier\IdentifierField;
use Laventure\Component\Database\ORM\Mapping\Identifier\IdentifierFieldInterface;
use Laventure\Component\Database\ORM\Mapping\Identifier\IdentifierFieldMapping;
use Laventure\Component\Database\ORM\Mapping\Property\Attribute\PropertyAttributeInterface;
use Laventure\Component\Database\ORM\Mapping\Property\Attribute\PropertyAttributeMapping;
use Laventure\Component\Database\ORM\Mapping\Property\PropertyMapping;
use Laventure\Component\Database\ORM\Mapping\Relationship\Relationship;
use Laventure\Component\Database\ORM\Mapping\Relationship\RelationshipInterface;
use Laventure\Utils\Convertor\CamelCase\CamelCaseConvertorTrait;
use ReflectionClass;
use ReflectionException;
use ReflectionObject;
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
    use identifierGeneratorTrait;


    /**
     * @var ReflectionClass
    */
    protected ReflectionClass $class;



    /**
     * @var ClassFieldMapping
    */
    protected ClassFieldMapping $classField;




    /**
     * @var IdentifierFieldMapping
    */
    protected IdentifierFieldMapping $identifierField;




    /**
     * @var Relationship
    */
    protected Relationship $relationship;




    /**
     * @var string|object
    */
    protected string|object $subject;



    /**
     * @var array
    */
    protected array $properties = [];



    /**
     * @var array<string, ClassField>
    */
    public array $fields = [];



    /**
     * @var array<string, Attribute>
    */
    public array $classAttributes = [];




    /**
     * @var array<string, PropertyAttributeInterface[]>
    */
    public array $propertyAttributes = [];





    /**
     * @var array<string, IdentifierField>
    */
    public array $identifiers = [];





    /**
     * @var array<string, SingleAssociationFieldInterface>
    */
    public array $singleAssociates = [];




    /**
     * @var array<string, CollectionAssociationFieldInterface>
    */
    public array $collectionAssociates = [];






    /**
     * @param string|object $subject
     * @throws ReflectionException
    */
    public function __construct(string|object $subject)
    {
        $this->subject              = $subject;
        $this->class                = new ReflectionClass($subject);
        $this->classField           = new ClassFieldMapping($this->class, $this->subject);
        $this->identifierField      = new IdentifierFieldMapping($this->classField);
        $this->relationship         = new Relationship($this);
        $this->properties           = $this->mapProperties($this->class);
        $this->classAttributes      = $this->mapClassAttributes($this->class);
        $this->propertyAttributes   = $this->mapPropertyAttributes($this->class);
        $this->fields               = $this->classField->map();
        $this->identifiers          = $this->identifierField->map();
        $this->singleAssociates     = $this->mapSingleAssociates($this->identifiers);
        $this->collectionAssociates = $this->mapCollectionAssociates($this->identifiers);
    }





    /**
     * @param $subject
     * @return static
     * @throws ReflectionException
    */
    public static function create($subject): static
    {
        return new static($subject);
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
    public function getSubject(): string|object
    {
        return $this->subject;
    }





    /**
     * @inheritDoc
    */
    public function getProperties(): array
    {
        return $this->properties;
    }




    /**
     * @param $name
     * @return bool
    */
    public function hasProperty($name): bool
    {
        return isset($this->properties[$name]);
    }





    /**
     * @param $name
     * @return ReflectionProperty
     * @throws NotFoundClassFieldException
    */
    public function getProperty($name): ReflectionProperty
    {
        if (!$this->hasProperty($name)) {
            throw new NotFoundClassFieldException($name);
        }

        return $this->properties[$name];
    }





    /**
     * @inheritDoc
    */
    public function getClassAttributes(): array
    {
       return $this->classAttributes;
    }




    /**
     * @inheritDoc
    */
    public function hasClassAttribute($name): bool
    {
        return isset($this->classAttributes[$name]);
    }




    /**
     * @inheritDoc
    */
    public function getClassAttribute($name): mixed
    {
        return $this->classAttributes[$name] ?? null;
    }





    /**
     * @inheritDoc
    */
    public function getPropertyAttributes(): array
    {
         return $this->propertyAttributes;
    }





    /**
     * @inheritDoc
    */
    public function hasPropertyAttribute($name): bool
    {
        return isset($this->propertyAttributes[$name]);
    }





    /**
     * @inheritDoc
    */
    public function getPropertyAttributesFor($name): array
    {
        return $this->propertyAttributes[$name] ?? [];
    }






    /**
     * @return Table|null
    */
    public function getTableAttribute(): ?Table
    {
        return $this->getClassAttribute(Table::class);
    }





    /**
     * @inheritDoc
    */
    public function getColumns(): array
    {
        $columns = [];

        if ($this->hasPropertyAttribute(Column::class)) {
            foreach ($this->propertyAttributes[Column::class] as $property) {
                /** @var Column $column */
                $column       = $property->getAttribute();
                $propertyName = $property->getPropertyName();
                $defaultName  = $this->camelCaseToUnderscore($propertyName);
                $column->name = $column->name ?: $defaultName;
                $columns[$property->getPropertyName()] = $column;
            }
        }

        return $columns;
    }




    /**
     * @inheritDoc
    */
    public function getRelationship(): RelationshipInterface
    {
        foreach ($this->relationship->getTypes() as $relation) {
             if ($this->hasPropertyAttribute($relation)) {
                 foreach ($this->getPropertyAttributesFor($relation) as $property) {
                     $this->relationship->associate(
                         $property->getPropertyName(),
                         $property->getAttribute()
                     );
                 }
             }
        }

        return $this->relationship;
    }






    /**
     * @inheritDoc
     * @throws NotFoundIdentifierException
    */
    public function getIdentifier(): string
    {
        if (!$this->hasPropertyAttribute(Id::class)) {
             throw new NotFoundIdentifierException($this->getName());
        }

        if (empty($this->getPropertyAttributesFor(Id::class)[0])) {
            throw new NotFoundIdentifierException($this->getName(), [
                'context' => "Could not found name of identity"
            ]);
        }

        $identifier = $this->getPropertyAttributesFor(Id::class)[0];

        return $identifier->getPropertyName();
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
    public function getShortName(): string
    {
        return $this->class->getShortName();
    }




    /**
     * @inheritDoc
    */
    public function getTableName(): string
    {
        $tableName = $this->getShortName();
        $table     = $this->getTableAttribute();
        $tableName = $table?->name ?? $tableName;

        return mb_strtolower($tableName);
    }








    /**
     * @inheritDoc
    */
    public function getTableAlias(): string
    {
        return $this->getTableName()[0];
    }








    /**
     * @inheritDoc
    */
    public function getFields(): array
    {
        return $this->fields;
    }






    /**
     * @inheritDoc
    */
    public function hasField($field): bool
    {
         return array_key_exists($field, $this->fields);
    }







    /**
     * @inheritDoc
     * @throws NotFoundClassFieldException
    */
    public function getField(string $field): ClassFieldInterface
    {
        if (!$this->hasField($field)) {
            throw new NotFoundClassFieldException($field);
        }

        return $this->fields[$field];
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

        return $this->fields[$field]->getTypeName();
    }






    /**
     * @inheritDoc
     */
    public function getFieldNames(): array
    {
        return array_keys($this->getFields());
    }







    /**
     * @inheritDoc
    */
    public function getIdentifierFieldNames(): array
    {
         return array_keys($this->getIdentifiers());
    }





    /**
     * @return IdentifierFieldInterface[]
    */
    public function getIdentifiers(): array
    {
        return $this->identifiers;
    }





    /**
     * @inheritDoc
    */
    public function getIdentifierValue(string $field): mixed
    {
         if (!$this->isIdentifier($field)) {
             return null;
         }

         return $this->identifiers[$field]->getValue();
    }






    /**
     * @inheritDoc
    */
    public function getAssociationNames(): array
    {
          return array_keys($this->getAssociationFields());
    }





    /**
     * @inheritDoc
    */
    public function getAssociationTargetClass($assocName): string
    {
        return $this->getRelationship()
                    ->getAssociate($assocName)
                    ->getTargetEntity();
    }





    /**
     * @inheritDoc
     * @throws ReflectionException
    */
    public function getAssociationMappedByTargetField($assocName): string
    {
        return $this->getRelationship()
                    ->getAssociate($assocName)
                    ->getReferenceColumn();
    }







    /**
     * @inheritDoc
     */
    public function getCollectionAssociations(): array
    {
        return $this->collectionAssociates;
    }







    /**
     * @inheritDoc
    */
    public function getSingleAssociations(): array
    {
        return $this->singleAssociates;
    }





    /**
     * @inheritDoc
    */
    public function getSingleAssociationValues(): array
    {
         return array_map(function (SingleAssociationFieldInterface $field) {
              return $field->getValue();
         }, $this->singleAssociates);
    }





    /**
     * @inheritDoc
     * @return mixed
     * @throws NotFoundClassFieldException
     * @throws NotFoundIdentifierException
    */
    public function getId(): mixed
    {
        return $this->getFieldValue($this->getIdentifier());
    }





    /**
     * @inheritDoc
     * @return mixed
     * @throws NotFoundClassFieldException
     * @throws NotFoundIdentifierException
    */
    public function getIdentityMapId($id = null): string
    {
        if (!$id) { $id = $this->getId(); }

        return sprintf('%s.%s', $this->getName(), $id);
    }




    /**
     * @return array<string, AssociatedFieldInterface>
    */
    public function getAssociationFields(): array
    {
         return array_filter($this->getFields(), function (ClassFieldInterface $field) {
             return $field->getTypeName()->isAssociation();
         });
    }






    /**
     * @inheritDoc
     * @throws NotFoundClassFieldException
    */
    public function fills(): array
    {
        $attributes = [];

        foreach ($this->getColumns() as $field => $column) {
            if ($this->hasField($field)) {
                $attributes[$column->name] = $this->getFieldResolvedValue($field);
            }
        }

        return $attributes;
    }






    /**
     * @inheritDoc
    */
    public function hasAssociation($field): bool
    {
        return array_key_exists($field, $this->getAssociationFields());
    }


    /**
     * @inheritDoc
     * @throws NotFoundIdentifierException
     * @throws NotFoundClassFieldException
    */
    public function isNew(): bool
    {
        return is_null($this->getId());
    }




    /**
     * @inheritDoc
     * @throws ReflectionException
     */
    public function setProperty($field, $value): static
    {
        $subject = $this->getSubject();

        $this->class->getProperty($field)->setValue($subject, $value);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function removeProperty($property): static
    {
        if ($this->hasProperty($property)) {
            unset($this->properties[$property]);
        }

        unset($this->getSubject()->{$property});

        return $this;
    }





    /**
     * @inheritDoc
     * @throws NotFoundClassFieldException
     * @throws ReflectionException
    */
    public function update(): object
    {
        $subject = $this->getSubject();
        $json    = json_encode($subject);
        $data    = json_decode($json, true);

        foreach ($data as $column => $value) {
            $property = $this->underscoreToCamelCase($column);
            if ($this->hasField($property)) {
                $field = $this->getField($property);
                $field->setValue($value);
                $this->setProperty($property, $field->getValue());
            }
            $this->removeProperty($column);
        }

        return $subject;
    }






    /**
     * @inheritDoc
    */
    public function isIdentifier($field): bool
    {
        return array_key_exists($field, $this->getIdentifiers());
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
    public function isAssociationInverseSide($assocName): bool {}









    /**
     * @param ReflectionClass $class
     * @return array
    */
    private function mapProperties(ReflectionClass $class): array
    {
       return PropertyMapping::create($class)->map();
    }




    /**
     * @param ReflectionClass $class
     * @return array
    */
    private function mapClassAttributes(ReflectionClass $class): array
    {
        return ClassAttributeMapping::create($class)->map();
    }





    /**
     * @param ReflectionClass $class
     * @return array
    */
    private function mapPropertyAttributes(ReflectionClass $class): array
    {
        return PropertyAttributeMapping::create($class)->map();
    }





    /**
     * @param array<string, IdentifierFieldInterface> $identifiers
     * @return array<string, SingleAssociationField>
    */
    private function mapSingleAssociates(array $identifiers): array
    {
         return array_filter($identifiers, function (IdentifierFieldInterface $field) {
              return $field instanceof SingleAssociationFieldInterface;
         });
    }





    /**
     * @param array<string, IdentifierFieldInterface> $identifiers
     * @return array<string, SingleAssociationField>
    */
    private function mapCollectionAssociates(array $identifiers): array
    {
        return array_filter($identifiers, function (IdentifierFieldInterface $field) {
            return $field instanceof CollectionAssociationFieldInterface;
        });
    }






    /**
     * @param $field
     * @return mixed
     * @throws NotFoundClassFieldException
    */
    private function getFieldResolvedValue($field): mixed
    {
        return $this->getField($field)->getColumnValue();
    }





    /**
     * @param $field
     * @return mixed
     * @throws NotFoundClassFieldException
    */
    public function getFieldValue($field): mixed
    {
        return $this->getField($field)->getValue();
    }






    /**
     * @inheritDoc
     */
    public function hasColumn($field): bool
    {
        return array_key_exists($field, $this->getColumns());
    }




    /**
     * @inheritDoc
    */
    public function getColumn($field): Column
    {
        if (!$this->hasColumn($field)) {
            throw new ClassMetadataException("No specified column for ($field)");
        }

        return $this->getColumns()[$field];
    }





    /**
     * @return string
    */
    public function getReferenceColumn(): string
    {
        return $this->generateReferenceColumn($this->getTableName());
    }
}
