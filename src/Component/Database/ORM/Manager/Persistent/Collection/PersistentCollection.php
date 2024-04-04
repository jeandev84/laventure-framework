<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Persistent\Collection;

use Laventure\Component\Database\ORM\Exceptions\NotFoundMethodException;
use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Mapping\Association\Collection\CollectionAssociationFieldInterface;
use Laventure\Component\Database\ORM\Mapping\Association\Single\SingleAssociationFieldInterface;
use Laventure\Component\Database\ORM\Mapping\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Mapping\Relationship\RelationshipInterface;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;

/**
 * PersistentCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Collection\Persistent
*/
class PersistentCollection implements PersistentCollectionInterface
{

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;



    /**
     * @var ClassMetadataInterface
    */
    protected ClassMetadataInterface $classMetadata;


    
    

    /**
     * @param EntityManagerInterface $em
     * @param object $subject
    */
    public function __construct(
        EntityManagerInterface $em,
        object $subject
    )
    {
        $this->em            = $em;
        $this->classMetadata = $em->getClassMetadata($subject);
    }





    /**
     * @param object $object
     * @return int
    */
    public function save(object $object): int
    {
        return $this->em->getUnitOfWork()->getDataMapper()->save($object);
    }





    /**
     * @param SingleAssociationFieldInterface $field
     * @return int
    */
    public function saveSingleAssociation(SingleAssociationFieldInterface $field): int
    {
        return $this->save($field->getValue());
    }






    /**
     * @param object $object
     * @return PersistentInterface
     */
    public function getPersistent(object $object): PersistentInterface
    {
        return $this->em->getUnitOfWork()->getPersistent($object);
    }





    /**
     * @inheritDoc
    */
    public function getCollectionAssociations(): array
    {
        return $this->classMetadata->getCollectionAssociations();
    }





    /**
     * @inheritDoc
    */
    public function getSingleAssociations(): array
    {
        return $this->classMetadata->getSingleAssociations();
    }





    /**
     * @return RelationshipInterface
     */
    public function getRelationship(): RelationshipInterface
    {
        return $this->classMetadata->getRelationship();
    }







    /**
     * @param string $targetEntity
     * @param array $criteria
     * @return array
    */
    public function findBy(string $targetEntity, array $criteria): array
    {
        $metadata = $this->em->getClassMetadata($targetEntity);
        $qb = $this->em->getConnection()->createQueryBuilder();

        return $qb->select()
                  ->from($metadata->getTableName())
                  ->criteria($criteria)
                  ->getQuery()
                  ->map($targetEntity)
                  ->fetch()
                  ->all();
    }







    /**
     * @return object
    */
    public function getSubject(): object
    {
        return $this->classMetadata->getSubject();
    }






    /**
     * @inheritDoc
    */
    public function persistCollectionAssociations(int $associatedId): static
    {
        foreach ($this->getCollectionAssociations() as $collectionField) {
            $this->saveCollectionAssociation($collectionField, $associatedId);
        }

        return $this;
    }




    /**
     * @param CollectionAssociationFieldInterface $field
     * @param int $associatedId
     * @return int
    */
    public function saveCollectionAssociation(CollectionAssociationFieldInterface $field, int $associatedId): int
    {
        $relationship      = $this->getRelationship()->getAssociate($field->getName());
        $collection        = $field->getCollection();
        $associatedColumn  = $relationship->getAssociatedColumn();

        foreach ($collection as $object) {
            $id         = $this->save($object);
            $persistent = $this->getPersistent($object);
            $persistent->addUpdate($id, [$associatedColumn => $associatedId])->update();
        }

        return $associatedId;
    }





    /**
     * @inheritDoc
    */
    public function persistSingleAssociations(int $associatedId): static
    {
         foreach ($this->getSingleAssociations() as $field) {
               $this->saveSingleAssociation($field);
         }

         return $this;
    }




    /**
     * @inheritDoc
     * @throws NotFoundMethodException
    */
    public function refresh(): object
    {
        $subject    = $this->getSubject();
        $subject    = $this->refreshCollectionAssociations($subject);
        return $this->refreshSingleAssociations($subject);
    }





    /**
     * @param object $subject
     * @return object
     * @throws NotFoundMethodException
    */
    private function refreshCollectionAssociations(object $subject): object
    {
        foreach ($this->getCollectionAssociations() as $field) {
            $subject = $this->refreshCollectionItems($field, $subject);
        }

        return $subject;
    }







    /**
     * @param CollectionAssociationFieldInterface $field
     * @param object $subject
     * @return object
     * @throws NotFoundMethodException
    */
    private function refreshCollectionItems(CollectionAssociationFieldInterface $field, object $subject): object
    {
        $mappedById = $this->classMetadata->getId();
        $relationship     = $this->getRelationship()->getAssociate($field->getName());
        $targetEntity     = $relationship->getTargetEntity();
        $associatedColumn = $relationship->getAssociatedColumn();
        $targetClass      = $this->em->getClassMetadata($targetEntity);
        $method           = sprintf('add%s', $targetClass->getShortName());

        if (!is_callable([$subject, $method])) {
            throw new NotFoundMethodException($this->classMetadata->getName(), $method);
        }

        $items = $this->findBy($targetEntity, [$associatedColumn => $mappedById]);

        foreach ($items as $item) {
            $this->em->getClassMetadata($item)->removeProperty($associatedColumn);
            call_user_func_array([$subject, $method], [$item]);
        }

        return $subject;
    }





    /**
     * @param object $object
     * @return object
    */
    private function refreshSingleAssociations(object $object): object
    {
        return $object;
    }
}
