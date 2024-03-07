<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata;

use Laventure\Component\Database\ORM\Persistence\Collection\Persistent\PersistentCollection;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Exception\NotFoundClassFieldException;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Types\ClassFieldType;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Types\ClassFieldTypeInterface;
use Laventure\Utils\Convertor\CamelCase\CamelCaseConvertorTrait;
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

    use CamelCaseConvertorTrait;


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
        return $this->reflection->getName();
    }






    /**
     * @inheritDoc
    */
    public function getReflectionClass(): Reflector
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
            throw new NotFoundClassFieldException($field, [
                "Undefined field form class {$this->getName()}"
            ]);
        }

        return new ClassFieldType($field, $this->getFieldValue($field));
    }





    /**
     * @param string $field
     * @param $default
     * @return mixed
    */
    public function getFieldValue(string $field, $default = null): mixed
    {
        return $this->fieldValues[$field] ?? $default;
    }





    /**
     * @param string $identifier
     * @param $default
     * @return mixed
    */
    public function getIdentifierValue(string $identifier, $default = null): mixed
    {
        return $this->identifierValues[$identifier] ?? $default;
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
    public function getAssociationTargetClass($assocName): mixed {}




    /**
     * @inheritDoc
    */
    public function isAssociationInverseSide($assocName): mixed {}






    /**
     * @inheritDoc
    */
    public function getAssociationMappedByTargetField($assocName): mixed {}




    /**
     * @inheritDoc
    */
    public function getIdentifierValues(object $object): array
    {
        $identifierValues = [];

        foreach ($this->getProperties() as $property) {
            $propertyName = $property->getName();
            $field        = $this->resolveFieldName($propertyName);
            $value        = $property->getValue($object);
            if ($this->identifier === $field) {
                $identifierValues[$field] = $value;
            } elseif ($this->isSingleValuedAssociation($field)) {
                #$field = trim($field, 's');
                $identifierValues["{$field}_id"] = $value;
            } elseif ($this->isCollectionValuedAssociation($field)) {
                $identifierValues[$field] = new PersistentCollection($field, $value);
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
            $field        = $this->resolveFieldName($propertyName);
            $value        = $property->getValue($object);
            $fieldValues[$field] = $value;
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




    /**
     * @param string $field
     * @return string
    */
    private function resolveFieldName(string $field): string
    {
        return $this->camelCaseToUnderscore($field);
    }
}
