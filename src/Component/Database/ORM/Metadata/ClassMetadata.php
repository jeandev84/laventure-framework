<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Metadata;

use ReflectionClass;
use ReflectionException;
use Reflector;

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
    /**
     * @var ReflectionClass
    */
    protected ReflectionClass $reflection;



    /**
     * @var string|object
    */
    protected $class;



    /**
     * @param $class
     * @throws ReflectionException
    */
    public function __construct($class)
    {
        $this->reflection = new ReflectionClass($class);
        $this->class      = $class;
    }



    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->reflection->getName();
    }




    /**
     * @inheritDoc
    */
    public function getReflector(): Reflector
    {
        return $this->reflection;
    }




    /**
     * @inheritDoc
    */
    public function getIdentifier(): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function isIdentifier($field): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function hasField($field): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function hasAssociation($field): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function isSingleValuedAssociation($field): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function isCollectionValuedAssociation($field): bool
    {

    }





    /**
     * @inheritDoc
    */
    public function getFieldNames(): array
    {

    }





    /**
     * @inheritDoc
    */
    public function getIdentifierFieldNames(): array
    {

    }





    /**
     * @inheritDoc
    */
    public function getAssociationNames(): array
    {

    }






    /**
     * @inheritDoc
    */
    public function getTypeOfField($field): mixed
    {

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
     * @inheritDoc
    */
    public function getIdentifierValues(object $object): mixed
    {

    }
}
