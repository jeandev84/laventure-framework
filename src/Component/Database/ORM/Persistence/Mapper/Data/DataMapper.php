<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapper\Data;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\Common\ObjectEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PostPersistEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PostUpdateEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PreUpdateEvent;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadata;
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
        $id = $this->persistent($object)->insert();

        $this->dispatchEvent(new PostPersistEvent($object));

        return $id;
    }




    /**
     * @param object $object
     * @return int
    */
    public function update(object $object): int
    {
        $preUpdateEvent  = new PreUpdateEvent($object);
        $this->dispatchEvent($preUpdateEvent);
        $object = $preUpdateEvent->getSubject();
        $this->persistent($object)->update();

        $postUpdateEvent = new PostUpdateEvent($object);
        $this->dispatchEvent($postUpdateEvent);
        $object = $postUpdateEvent->getSubject();
        $this->dispatchEvent(new PostUpdateEvent($object));

        return $this->getId($object);
    }





    /**
     * @inheritDoc
    */
    public function save(object $object): int
    {
        return 0;
    }




    /**
     * @inheritDoc
    */
    public function delete(object $object): bool
    {
        return false;
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
    public function persistent(object $object): Persistent
    {
         return $this->em->getUnitOfWork()
                         ->getPersistent($object);
    }





    /**
     * @param object $object
     * @return int
    */
    public function getId(object $object): int
    {
        return $this->em->getClassMetadata($object)->getId();
    }
}
