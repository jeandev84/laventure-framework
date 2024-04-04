<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Relationship;

use Laventure\Component\Database\ORM\Mapping\Identifier\Generator\Traits\identifierGeneratorTrait;
use Laventure\Component\Database\ORM\Mapping\Relationship\Exception\RelationshipException;
use ReflectionException;

/**
 * AssociatedAttribute
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Metadata\Relationship
*/
abstract class AssociatedAttribute
{


    /**
     * @var string|null
    */
    protected ?string $associatedColumn = null;


    /**
     * @var string|null
    */
    protected ?string $associatedTable = null;


    /**
     * @param string|null $targetEntity
     * @param string|null $referenceColumn
     * @param array $cascade
    */
    public function __construct(
        protected ?string $targetEntity = null,
        protected ?string $referenceColumn = null,
        protected array  $cascade = []
    )
    {
    }





    /**
     * @param string $targetEntity
     * @return AssociatedAttribute
    */
    public function setTargetEntity(string $targetEntity): static
    {
        $this->targetEntity = $targetEntity;

        return $this;
    }






    /**
     * @return string|null
    */
    public function getTargetEntity(): ?string
    {
        return $this->targetEntity;
    }






    /**
     * @param string $referenceColumn
     * @return AssociatedAttribute
    */
    public function setReferenceColumn(string $referenceColumn): static
    {
        $this->referenceColumn = $referenceColumn;

        return $this;
    }






    /**
     * @return string|null
    */
    public function getReferenceColumn(): ?string
    {
        return $this->referenceColumn;
    }





    /**
     * @param $id
     * @return bool
    */
    public function hasCascade($id): bool
    {
        return in_array($id, $this->cascade);
    }





    /**
     * @return bool
    */
    public function hasCascadePersist(): bool
    {
        return $this->hasCascade(CascadeType::PERSIST);
    }





    /**
     * @return bool
    */
    public function hasCascadeRemove(): bool
    {
        return $this->hasCascade(CascadeType::REMOVE);
    }





    /**
     * @param string $associatedColumn
     * @return AssociatedAttribute
    */
    public function setAssociatedColumn(string $associatedColumn): static
    {
        $this->associatedColumn = $associatedColumn;

        return $this;
    }





    /**
     * @return string|null
    */
    public function getAssociatedColumn(): ?string
    {
        return $this->associatedColumn;
    }




    /**
     * @param string $associatedTable
     * @return $this
    */
    public function setAssociatedTable(string $associatedTable): static
    {
        $this->associatedTable = $associatedTable;

        return $this;
    }






    /**
     * @return string
     * @throws RelationshipException
    */
    public function getAssociatedTable(): string
    {
         if (!$this->associatedTable) {
             throw new RelationshipException("No specified associate table inside (". get_called_class() . ")");
         }

         return $this->associatedTable;
    }
}