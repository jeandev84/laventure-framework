<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata;

use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Types\ClassFieldTypeInterface;
use ReflectionClass;

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
     * Returns class name
     *
     * @return string
    */
    public function getName(): string;







    /**
     * Set identifier
     *
     * @param string $identifier
     * @return $this
    */
    public function setIdentifier(string $identifier): static;





    /**
     * Returns class identifier
     *
     * @return mixed
    */
    public function getIdentifier(): mixed;








    /**
     * @return ReflectionClass
    */
    public function getReflectionClass(): ReflectionClass;




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
     * Determine if is association inverse side
     *
     * @param $assocName
     * @return mixed
    */
    public function isAssociationInverseSide($assocName): mixed;







    /**
     * Returns association mapped by target field
     *
     * @param $assocName
     * @return mixed
    */
    public function getAssociationMappedByTargetField($assocName): mixed;







    /**
     * Returns identifiers values
     *
     * @param object $object
     * @return mixed
    */
    public function getIdentifierValues(object $object): mixed;








    /**
     * Returns fields values
     *
     * @param object $object
     * @return mixed
    */
    public function getFieldValues(object $object): mixed;







    /**
     * Returns field value
     *
     * @param string $field
     * @return mixed
    */
    public function getFieldValue(string $field): mixed;






    /**
     * Returns identifier value
     *
     * @param string $field
     * @return mixed
    */
    public function getIdentifierValue(string $field): mixed;







    /**
     * Returns all attributes
     *
     * @return array
    */
    public function getAttributes(): array;





    /**
     * Remove attribute
     *
     * @param $name
     * @return $this
    */
    public function withoutAttribute($name): static;





    /**
     * Remove attributes
     *
     * @param array $names
     * @return $this
    */
    public function withoutAttributes(array $names): static;






    /**
     * Returns all attributes without class identifier
     *
     * @return array
    */
    public function getPersistAttributes(): array;





    /**
     * Returns value identifier class
     *
     * @return mixed
    */
    public function getId(): mixed;








    /**
     * Determine if object is new
     *
     * @return bool
    */
    public function isNew(): bool;
}
