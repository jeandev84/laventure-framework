<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapper\Data;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\Common\ObjectEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PostPersistEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PostRemoveEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PostUpdateEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PrePersistEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PreRemoveEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PreUpdateEvent;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Persistent;

/**
 * DataMapper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapper\Data
*/
class DataMapper implements DataMapperInterface
{
    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;


    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }





    /**
     * @inheritDoc
    */
    public function find($id): ?object
    {
        return $this->em->getUnitOfWork()->find($id);
    }







    /**
     * @param object $object
     * @return int
    */
    public function insert(object $object): int
    {
        $persistent = $this->getPersistent($object);

        $id = $persistent->insert();

        $this->dispatchEvent(new PostPersistEvent($object));

        $persistent->mapIdentity($id, $object);

        return $id;
    }








    /**
     * @param object $object
     * @return int
    */
    public function update(object $object): int
    {
        $persistent      = $this->getPersistent($object);
        $preUpdateEvent  = new PreUpdateEvent($object);
        $this->dispatchEvent($preUpdateEvent);
        $object = $preUpdateEvent->getSubject();
        $persistent->update();

        $postUpdateEvent = new PostUpdateEvent($object);
        $this->dispatchEvent($postUpdateEvent);
        $object = $postUpdateEvent->getSubject();
        $this->dispatchEvent(new PostUpdateEvent($object));
        $id = $this->getId($object);

        $persistent->mapIdentity($id, $object);

        return $id;
    }





    /**
     * @inheritDoc
    */
    public function save(object $object): int
    {
         $prePersistEvent = new PrePersistEvent($object);
         $this->dispatchEvent($prePersistEvent);
         $object = $prePersistEvent->getSubject();

         if ($this->isNew($object)) {
             $id = $this->insert($object);
         } else {
             $id = $this->update($object);
         }

         return $id;
    }






    /**
     * @inheritDoc
    */
    public function delete(object $object): bool
    {
        $preRemoveEvent = new PreRemoveEvent($object);
        $this->dispatchEvent($preRemoveEvent);
        $object = $preRemoveEvent->getSubject();

        $status = $this->getPersistent($object)->remove();

        $postRemoveEvent = new PostRemoveEvent($object);
        $this->dispatchEvent($postRemoveEvent);

        $this->em->detach($object);

        return $status;
    }








    /**
     * @param ObjectEvent $event
     * @return object
    */
    public function dispatchEvent(ObjectEvent $event): object
    {
         return $this->em->getEventManager()
                         ->dispatchEvent($event);
    }





    /**
     * @param object $object
     * @return Persistent
    */
    public function getPersistent(object $object): Persistent
    {
         return $this->em->getUnitOfWork()
                         ->getPersistent($object);
    }





    /**
     * @param object $object
     * @return ClassMetadataInterface
    */
    public function getClassMetadata(object $object): ClassMetadataInterface
    {
        return $this->em->getClassMetadata($object);
    }





    /**
     * @param object $object
     * @return int
    */
    public function getId(object $object): int
    {
        return $this->getClassMetadata($object)->getId();
    }






    /**
     * @param object $object
     * @return bool
    */
    public function isNew(object $object): bool
    {
        return $this->getClassMetadata($object)->isNew();
    }
}
