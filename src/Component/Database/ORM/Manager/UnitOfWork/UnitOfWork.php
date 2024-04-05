<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\UnitOfWork;

use Laventure\Component\Database\ORM\Common\Storage\ObjectStorage;
use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Manager\Events\OnClearEvent;
use Laventure\Component\Database\ORM\Manager\Mapper\DataMapper;
use Laventure\Component\Database\ORM\Manager\Persistent\Collection\PersistentCollection;
use Laventure\Component\Database\ORM\Manager\Persistent\Collection\PersistentCollectionInterface;
use Laventure\Component\Database\ORM\Manager\Persistent\Persistent;
use Laventure\Component\Database\ORM\Mapper\Data\DataMapperInterface;
use Laventure\Component\Database\ORM\Mapper\Identity\IdentityMapperInterface;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;
use Laventure\Component\Database\ORM\UnitOfWork\UnitOfWorkInterface;
use Laventure\Component\Database\Schema\Table\Exception\NotFoundTableException;


/**
 * UnitOfWork
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\UnitOfWork
*/
class UnitOfWork implements UnitOfWorkInterface
{
    public const STATE_MANAGED   = 1;
    public const STATE_NEW       = 2;
    public const STATE_DETACHED  = 3;
    public const STATE_REMOVED   = 4;




    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;




    /**
     * @var ObjectStorage
    */
    protected ObjectStorage $storage;




    /**
     * @var EventManagerInterface
    */
    protected EventManagerInterface $eventManager;




    /**
     * @var DataMapper
    */
    protected DataMapper $dataMapper;






    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em           = $em;
        $this->eventManager = $em->getEventManager();
        $this->dataMapper   = new DataMapper($em);
        $this->storage      = new ObjectStorage();
    }





    /**
     * @inheritDoc
     * @throws NotFoundTableException
    */
    public function getPersistent($class): PersistentInterface
    {
        return new Persistent($this->em, $class);
    }





    /**
     * @inheritDoc
     * @param $class
     * @return PersistentCollectionInterface
   */
    public function getPersistCollection($class): PersistentCollectionInterface
    {
        return new PersistentCollection($this->em, $class);
    }





    /**
     * @inheritDoc
    */
    public function getDataMapper(): DataMapperInterface
    {
        return $this->dataMapper;
    }





    /**
     * @inheritDoc
    */
    public function getStorage(): ObjectStorage
    {
        return $this->storage;
    }






    /**
     * @inheritdoc
    */
    public function registerObjectState(object $object, $state): static
    {
        $this->storage->attach($object, $state);

        return $this;
    }





    /**
     * @inheritDoc
     * @param object $object
     * @return bool
    */
    public function isNew(object $object): bool
    {
        return $this->em->getClassMetadata($object)->isNew();
    }







    /**
     * @inheritDoc
     */
    public function registerPersist(object $object): static
    {
        // add states
        if ($this->isNew($object)) {
            $this->registerNewState($object);
        } else {
            $this->registerManagedState($object);
        }

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function registerNewState(object $object): static
    {
        return $this->registerObjectState($object, self::STATE_NEW);
    }





    /**
     * @inheritDoc
     */
    public function registerManagedState(object $object): static
    {
        return $this->registerObjectState($object, self::STATE_MANAGED);
    }





    /**
     * @inheritDoc
    */
    public function registerDetachedState(object $object): static
    {
        return $this->registerObjectState($object, self::STATE_DETACHED);
    }






    /**
     * @inheritDoc
    */
    public function registerRemovedState(object $object): static
    {
        // subscribe persist event
        $this->eventManager->subscribeRemoveEvents();

        // add state
        return $this->registerObjectState($object, self::STATE_REMOVED);
    }





    /**
     * Example:
     *
     * $unitOfWork->find(User::class, 1)
     *
     * @inheritDoc
     * @param $class
     * @param $id
     * @return mixed
    */
    public function find($class, $id): mixed
    {
        return $this->dataMapper->find($class, $id);
    }





    /**
     * @inheritDoc
    */
    public function persist(object $object): static
    {
        // subscribe persist event
        $this->eventManager->subscribePersistEvents();

        return $this->registerPersist($object);
    }






    /**
     * @inheritDoc
    */
    public function remove(object $object): static
    {
        return $this->registerRemovedState($object);
    }




    /**
     * @inheritDoc
    */
    public function refresh(object $object): static
    {
        $object = $this->getPersistCollection($object)->refresh();

        $this->attach($object);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function attach(object $object): static
    {
        $this->storage->attach($object);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function detach(object $object): static
    {
        $this->storage->detach($object);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function merge(object $object): static
    {
        $this->em->getClassMetadata($object)->update();

        $this->attach($object);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function contains(object $object): bool
    {
        return $this->storage->contains($object);
    }




    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->eventManager->dispatchEvent(
            new OnClearEvent($this->em)
        );

        $this->storage->clear();
        $this->dataMapper->getIdentityMap()->clear();
    }





    /**
     * @inheritDoc
    */
    public function commit(): mixed
    {
        return $this->em->transaction(function () {
            foreach ($this->storage as $object) {
                $state = $this->storage->getInfo();
                switch ($state):
                    case self::STATE_MANAGED:
                    case self::STATE_NEW:
                        $this->save($object);
                        break;
                    case self::STATE_REMOVED:
                        $this->delete($object);
                        break;
                endswitch;
            }
            $this->clear();
        });
    }





    /**
     * @param object $object
     * @return int
    */
    public function save(object $object): int
    {
        // save object to the database
        $id = $this->dataMapper->save($object);

        // save collection and single associations
        $persistentCollection = $this->getPersistCollection($object);
        $persistentCollection->persistCollectionAssociations($id);
        $persistentCollection->persistSingleAssociations($id);

        return $id;
    }





    /**
     * @param object $object
     * @return bool
    */
    public function delete(object $object): bool
    {
        return $this->dataMapper->delete($object);
    }
}
