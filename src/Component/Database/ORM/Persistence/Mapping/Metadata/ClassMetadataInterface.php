<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata;

use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Types\ClassFieldTypeInterface;
use Reflector;

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
     * Returns class identifier
     *
     * @return mixed
    */
    public function getIdentifier(): mixed;




    /**
     * @return Reflector
    */
    public function getReflector(): Reflector;




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
}
