<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata;

use Laventure\Component\Database\ORM\Persistence\Collection\PersistenceCollection;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Exception\NotFoundClassFieldException;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\ClassFieldType;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\ClassFieldTypeInterface;
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
     * @var array
    */
    protected array $fieldValues = [];




    /**
     * @var array
    */
    protected array $identifierValues = [];






    /**
     * @param $class
     * @throws ReflectionException
    */
    public function __construct($class)
    {
        $this->reflection = new ReflectionClass($class);
        $this->class      = $class;

        if (is_object($class)) {
            $this->fieldValues      = $this->getFieldValues($class);
            $this->identifierValues = $this->getIdentifierValues($class);
        }
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
        return array_keys($this->identifierValues);
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
    public function getTypeOfField($field): ClassFieldTypeInterface
    {
        if (!$this->hasField($field)) {
            throw new NotFoundClassFieldException($field, ["fromClass" => $this->getName()]);
        }

        return new ClassFieldType($field, $this->fieldValues[$field]);
    }


    
    

    /**
     * @inheritDoc
    */
    public function hasAssociation($field): bool
    {
        return $this->getTypeOfField($field)->isAssociation();
    }






    /**
     * @inheritDoc
    */
    public function isSingleValuedAssociation($field): bool
    {
        return $this->getTypeOfField($field)->isSingleAssociate();
    }




    /**
     * @inheritDoc
    */
    public function isCollectionValuedAssociation($field): bool
    {
        return $this->getTypeOfField($field)->isCollectionAssociate();
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
     * @inheritDoc
    */
    public function getIdentifierValues(object $object): array
    {
        $identifierValues = [];

        foreach ($this->getProperties() as $property) {
            $field = $property->getName();
            $value        = $property->getValue($object);
            if ($field === $this->identifier) {
                $identifierValues[$field] = $value;
            } elseif ($this->isSingleValuedAssociation($field)) {
                #$field = trim($field, 's');
                $identifierValues["{$field}_id"] = $value;
            } elseif ($this->isCollectionValuedAssociation($field)) {
                $identifierValues[$field] = new PersistenceCollection($field, $value);
            }
        }

        return $identifierValues;
    }

    
    



    /**
     * @param object $object
     * @return array
    */
    public function getFieldValues(object $object): array
    {
        $fieldValues = [];

        foreach ($this->getProperties() as $property) {
            $propertyName = $property->getName();
            $value        = $property->getValue($object);
            $fieldValues[$propertyName] = $value;
        }

        return $fieldValues;
    }






    /**
     * @return ReflectionProperty[]
    */
    private function getProperties(): array
    {
        return $this->reflection->getProperties();
    }
}
