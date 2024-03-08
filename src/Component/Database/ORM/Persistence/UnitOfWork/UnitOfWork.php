<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\UnitOfWork;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\OnClearEvent;
use Laventure\Component\Database\ORM\Persistence\Mapper\Data\DataMapper;
use Laventure\Component\Database\ORM\Persistence\Mapper\Data\DataMapperInterface;
use Laventure\Component\Database\ORM\Persistence\Mapper\Identity\IdentityMap;
use Laventure\Component\Database\ORM\Persistence\Mapper\Identity\IdentityMapperInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Persistent;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;
use Laventure\Component\Database\ORM\Persistence\Storage\ObjectStorage;
use ReflectionException;
use SplObjectStorage;

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
     * @var DataMapperInterface
    */
    protected DataMapperInterface $dataMapper;





    /**
     * @var IdentityMapperInterface|null
    */
    protected ?IdentityMapperInterface $identityMap = null;





    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em           = $em;
        $this->eventManager = $em->getEventManager();
        $this->dataMapper   = $em->getDataMapper();
        $this->storage      = new ObjectStorage();;
    }




    /**
     * @inheritDoc
     */
    public function getPersistent($class): PersistentInterface
    {
        return new Persistent($this->em, $class);
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
     * @inheritDoc
    */
    public function getIdentityMap(): IdentityMapperInterface
    {
        if (!$this->identityMap) {
            $this->identityMap  = new IdentityMap();
        }

        return $this->identityMap;
    }







    /**
     * @inheritdoc
    */
    public function registerObject(object $object, $state): static
    {
        $this->storage->attach($object, $state);

        return $this;
    }





    /**
     * @inheritDoc
     * @throws ReflectionException
     */
    public function isNew(object $object): bool
    {
        return ClassMetadata::create($object)->isNew();
    }

    
    
    



    /**
     * @inheritDoc
     * @throws ReflectionException
     */
    public function registerPersist(object $object): static
    {
        // add states
        if ($this->isNew($object)) {
            $this->registerNew($object);
        } else {
            $this->registerManaged($object);
        }

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function registerNew(object $object): static
    {
        return $this->registerObject($object, self::STATE_NEW);
    }





    /**
     * @inheritDoc
     */
    public function registerManaged(object $object): static
    {
        return $this->registerObject($object, self::STATE_MANAGED);
    }





    /**
     * @inheritDoc
    */
    public function registerDetached(object $object): static
    {
        return $this->registerObject($object, self::STATE_DETACHED);
    }






    /**
     * @inheritDoc
    */
    public function registerRemoved(object $object): static
    {
        // subscribe persist events
        $this->eventManager->subscribeRemoveEvents();

        // add state
        return $this->registerObject($object, self::STATE_REMOVED);
    }






    /**
     * @inheritDoc
     * @throws ReflectionException
    */
    public function persist(object $object): static
    {
        // subscribe persist events
        $this->eventManager->subscribePersistEvents();

        return $this->registerPersist($object);
    }






    /**
     * @inheritDoc
    */
    public function remove(object $object): static
    {
        return $this->registerRemoved($object);
    }




    /**
     * @inheritDoc
    */
    public function refresh(object $object): static
    {
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
        return $this->attach($object);
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
    public function commit(): mixed
    {
        return $this->em->transaction(function () {
            foreach ($this->storage as $object) {
                $state = $this->storage->getInfo();
                switch ($state):
                    case self::STATE_MANAGED:
                    case self::STATE_NEW:
                        $this->dataMapper->save($object);
                        break;
                    case self::STATE_REMOVED:
                        $this->dataMapper->delete($object);
                        break;
                endswitch;
            }
            $this->clear();
        });
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
        $this->getIdentityMap()->clear();
    }
}
