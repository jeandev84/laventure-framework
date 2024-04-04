<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Relationship;

use Laventure\Component\Database\ORM\Mapping\Attributes\ManyToMany;
use Laventure\Component\Database\ORM\Mapping\Attributes\ManyToOne;
use Laventure\Component\Database\ORM\Mapping\Attributes\OneToMany;
use Laventure\Component\Database\ORM\Mapping\Attributes\OneToOne;
use Laventure\Component\Database\ORM\Mapping\ClassMetadata;
use Laventure\Component\Database\ORM\Mapping\Relationship\Exception\NotFoundRelationshipException;
use Laventure\Component\Database\ORM\Mapping\Relationship\Exception\RelationshipException;
use ReflectionException;

/**
 * Relationship
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Relationship
*/
class Relationship implements RelationshipInterface
{


    /**
     * @var array
    */
    public array $associated = [];




    /**
     * @param ClassMetadata $class
    */
    public function __construct(
        protected ClassMetadata $class
    )
    {
    }




    /**
     * @param $field
     * @param AssociatedAttribute $associated
     * @return Relationship
     * @throws RelationshipException
     * @throws ReflectionException
     */
    public function associate($field, AssociatedAttribute $associated): static
    {
        if ($targetEntity = $associated->getTargetEntity()) {
            $class = new ClassMetadata($targetEntity);
            if (!$associated->getReferenceColumn()) {
                $associated->setReferenceColumn($this->generateReferenceColumn($class->getTableName()));
            }
            $associated->setAssociatedColumn(
                $this->generateReferenceColumn($this->class->getTableName())
            );
        } else {
            $associated->setTargetEntity($this->class->getName());
            if (!$associated->getReferenceColumn()) {
                $associated->setReferenceColumn($this->class->getReferenceColumn());
            }
            $associatedTable = $associated->getAssociatedTable();
            $associated->setAssociatedColumn($this->generateReferenceColumn($associatedTable));
        }

        $this->associated[$field] = $associated;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function hasAssociatedField($field): bool
    {
        return isset($this->associated[$field]);
    }






    /**
     * @param $field
     * @return AssociatedAttribute
     * @throws NotFoundRelationshipException
    */
    public function getAssociate($field): AssociatedAttribute
    {
        if (!$this->hasAssociatedField($field)) {
             throw new NotFoundRelationshipException($field);
        }

        return $this->associated[$field];
    }





    /**
     * @inheritDoc
    */
    public function getTypes(): array
    {
        return [
            OneToMany::class,
            ManyToOne::class,
            OneToOne::class,
            ManyToMany::class
        ];
    }




    /**
     * @inheritDoc
    */
    public function toArray(): array
    {
       return get_object_vars($this);
    }




    /**
     * @param string $from
     * @return string
    */
    protected function generateReferenceColumn(string $from): string
    {
        return $this->class->generateReferenceColumn($from);
    }
}