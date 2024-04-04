<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Mapper;

use Laventure\Component\Database\ORM\Manager\Events\PostPersistEvent;
use Laventure\Component\Database\ORM\Manager\Events\PostRemoveEvent;
use Laventure\Component\Database\ORM\Manager\Events\PostUpdateEvent;
use Laventure\Component\Database\ORM\Manager\Events\PrePersistEvent;
use Laventure\Component\Database\ORM\Manager\Events\PreRemoveEvent;
use Laventure\Component\Database\ORM\Manager\Events\PreUpdateEvent;
use Laventure\Component\Database\ORM\Manager\Mapper\Common\ObjectMapper;


/**
 * Data
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Manager\Data
*/
class DataMapper extends ObjectMapper
{
    /**
     * @inheritDoc
    */
    public function find($class, $id): ?object
    {
        if (!$this->hasIdentityMapId($class, $id)) {

           $data = $this->em->getUnitOfWork()
                            ->getPersistent($class)
                            ->find($id);

           if (!is_object($data)) {
               return null;
           }

           $this->map($id, $data);
        }

        return $this->load($class, $id);
    }






    /**
     * @inheritDoc
    */
    public function insert(object $object): int
    {
        $id = $this->getPersistent($object)->insert();

        $this->dispatchEvent(new PostPersistEvent($object));

        return $this->map($id, $this->findFromObject($object, $id));
    }








    /**
     * @inheritDoc
    */
    public function update(object $object): int
    {
        $preUpdateEvent  = new PreUpdateEvent($object);
        $this->dispatchEvent($preUpdateEvent);
        $object = $preUpdateEvent->getSubject();
        $this->getPersistent($object)->update();

        $postUpdateEvent = new PostUpdateEvent($object);
        $this->dispatchEvent($postUpdateEvent);
        $object = $postUpdateEvent->getSubject();
        $this->dispatchEvent(new PostUpdateEvent($object));
        $id = $this->getId($object);

        return $this->map($id, $this->findFromObject($object, $id));
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
}
