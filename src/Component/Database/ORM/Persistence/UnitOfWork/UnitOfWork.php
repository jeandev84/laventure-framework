<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\UnitOfWork;

use Laventure\Component\Database\ORM\Persistence\Manager\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Persistent;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;
use Laventure\Component\Database\ORM\Persistence\Storage\ObjectStorage;

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
     * @var ClassMetadataFactoryInterface
    */
    protected ClassMetadataFactoryInterface $metadataFactory;





    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em           = $em;
        $this->eventManager = $em->getEventManager();
        $this->storage      = new ObjectStorage();
    }






    /**
     * @inheritDoc
    */
    public function getPersistent($class): PersistentInterface
    {
         return new Persistent();
    }






    /**
     * @inheritdoc
    */
    public function registerState(object $object, $state): static
    {
         $this->storage->attach($object, $state);

         return $this;
    }





    /**
     * @param object $object
     * @return $this
    */
    public function registerPersistState(object $object): static
    {

    }





    /**
     * @param object $object
     * @return $this
    */
    public function registerNewState(object $object): static
    {

    }





    /**
     * @param object $object
     * @return $this
    */
    public function registerDetachedState(object $object): static
    {

    }






    /**
     * @param object $object
     * @return $this
    */
    public function registerRemovedState(object $object): static
    {
         return $this;
    }







    /**
     * @inheritDoc
    */
    public function find(int $id): ?object
    {

    }




    /**
     * @inheritDoc
    */
    public function persist(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function remove(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function refresh(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function attach(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function detach(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function merge(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function contains(object $object): bool
    {

    }



    /**
     * @inheritDoc
    */
    public function isNew(object $object): bool
    {

    }



    /**
     * @inheritDoc
    */
    public function commit(): void
    {

    }





    /**
     * Clear storage
     *
     * @return void
    */
    public function clear(): void
    {
        $this->storage->clear();
    }
}
