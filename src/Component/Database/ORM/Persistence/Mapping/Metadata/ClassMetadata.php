<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
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
     * @var string
    */
    protected string $identifier = 'id';





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
        return [];
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
        return array_map(function (ReflectionProperty $property) {
            return $property->getName();
        }, $this->getProperties());
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




    /**
     * @return ReflectionProperty[]
    */
    private function getProperties(): array
    {
        return $this->reflection->getProperties();
    }
}
