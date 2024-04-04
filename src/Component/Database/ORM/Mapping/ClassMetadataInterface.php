<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping;

use Attribute;
use Laventure\Component\Database\ORM\Mapping\Association\Collection\CollectionAssociationFieldInterface;
use Laventure\Component\Database\ORM\Mapping\Association\Single\SingleAssociationFieldInterface;
use Laventure\Component\Database\ORM\Mapping\Attributes\Column;
use Laventure\Component\Database\ORM\Mapping\Field\ClassFieldInterface;
use Laventure\Component\Database\ORM\Mapping\Field\Types\ClassFieldTypeInterface;
use Laventure\Component\Database\ORM\Mapping\Property\Attribute\PropertyAttributeInterface;
use Laventure\Component\Database\ORM\Mapping\Relationship\RelationshipInterface;
use ReflectionClass;
use ReflectionProperty;

/**
 * ClassMetadataInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Metadata
*/
interface ClassMetadataInterface
{

    /**
     * @return ReflectionClass
     */
    public function getReflectionClass(): ReflectionClass;




    /**
     * Returns parsed class or object
     *
     * @return string|object
    */
    public function getSubject(): mixed;





    /**
     * Returns class name
     *
     * @return string
    */
    public function getName(): string;





    /**
     * @return string
    */
    public function getShortName(): string;





    /**
     * Returns class table name
     *
     * @return string
    */
    public function getTableName(): string;





    /**
     * Returns table alias
     *
     * @return string
    */
    public function getTableAlias(): string;





    /**
     * Returns class identifier
     *
     * @return mixed
    */
    public function getIdentifier(): mixed;





    /**
     * Returns properties
     *
     * @return array<string, ReflectionProperty>
    */
    public function getProperties(): array;





    /**
     * Returns class attributes
     *
     * @return Attribute[]
    */
    public function getClassAttributes(): array;




    /**
     * @param $name
     * @return bool
    */
    public function hasClassAttribute($name): bool;





    /**
     * Returns attributes by given class attribute name
     *
     * @param $name
     * @return Attribute|null
     */
    public function getClassAttribute($name): mixed;






    /**
     * @return array<string, PropertyAttributeInterface>
    */
    public function getPropertyAttributes(): array;






    /**
     * @param $name
     * @return bool
    */
    public function hasPropertyAttribute($name): bool;




    /**
     * @param $name
     * @return PropertyAttributeInterface[]
    */
    public function getPropertyAttributesFor($name): array;





    /**
     * Determine if exist named column by given property
     *
     * @param $field
     * @return bool
    */
    public function hasColumn($field): bool;





    /**
     * @param $field
     * @return Column
    */
    public function getColumn($field): Column;






    /**
     * Returns all columns
     *
     * @return Column[]
    */
    public function getColumns(): array;







    /**
     * Returns fields
     *
     * @return array<string, ClassFieldInterface>
    */
    public function getFields(): array;






    /**
     * @return RelationshipInterface
    */
    public function getRelationship(): RelationshipInterface;









    /**
     * Returns field names
     *
     * @return array
    */
    public function getFieldNames(): array;






    /**
     * Returns identifier field names
     *
     * @return array
    */
    public function getIdentifierFieldNames(): array;






    /**
     * Returns association names
     *
     * @return array
    */
    public function getAssociationNames(): array;







    /**
     * Returns type of fields
     *
     * @param $field
     * @return ClassFieldTypeInterface
    */
    public function getTypeOfField($field): ClassFieldTypeInterface;






    /**
     * Returns association target class
     *
     * @param $assocName
     * @return mixed
    */
    public function getAssociationTargetClass($assocName): mixed;









    /**
     * Returns association mapped by target field
     *
     * @param $assocName
     * @return mixed
    */
    public function getAssociationMappedByTargetField($assocName): mixed;







    /**
     * Returns field value
     *
     * @param string $field
     * @return ClassFieldInterface
    */
    public function getField(string $field): ClassFieldInterface;






    /**
     * Returns identifier value
     *
     * @param string $field
     * @return mixed
    */
    public function getIdentifierValue(string $field): mixed;








    /**
     * Returns collection association
     *
     * @return CollectionAssociationFieldInterface[]
    */
    public function getCollectionAssociations(): array;







    /**
     * Returns all single associations
     *
     * @return SingleAssociationFieldInterface[]
    */
    public function getSingleAssociations(): array;





    /**
     * Returns single association attributes
     *
     * @return array
    */
    public function getSingleAssociationValues(): array;






    /**
     * Returns value identifier class
     *
     * @return mixed|int|null
    */
    public function getId(): mixed;





    /**
     * Returns identity map ID
     *
     * @param null $id
     * @return string
    */
    public function getIdentityMapId($id = null): string;





    /**
     * Returns fills attributes
     *
     * @return array
    */
    public function fills(): array;






    /**
     * Determine if object is new
     *
     * @return bool
    */
    public function isNew(): bool;






    /**
     * Set property
     *
     * @param $field
     * @param $value
     * @return $this
    */
    public function setProperty($field, $value): static;






    /**
     * Remove property
     *
     * @param $property
     * @return $this
    */
    public function removeProperty($property): static;







    /**
     * Refresh values of subject
     *
     * @return object
    */
    public function update(): object;







    /**
     * Determine if the given column is identifier
     *
     * @param $field
     * @return bool
     */
    public function isIdentifier($field): bool;







    /**
     * Determine if the given field exist
     *
     * @param $field
     * @return bool
     */
    public function hasField($field): bool;






    /**
     * Determine if is associative $field
     *
     * @param $field
     * @return bool
     */
    public function hasAssociation($field): bool;







    /**
     * Determine if is single valued associative $field
     *
     * @param $field
     * @return bool
     */
    public function isSingleValuedAssociation($field): bool;






    /**
     * Determine if given field is collection valued association
     *
     * @param $field
     * @return bool
     */
    public function isCollectionValuedAssociation($field): bool;









    /**
     * Determine if is association inverse side
     *
     * @param $assocName
     * @return bool
     */
    public function isAssociationInverseSide($assocName): bool;
}
