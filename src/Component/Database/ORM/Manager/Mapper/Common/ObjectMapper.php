<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Mapper\Common;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Manager\Events\Common\ObjectEvent;
use Laventure\Component\Database\ORM\Manager\Persistent\Persistent;
use Laventure\Component\Database\ORM\Mapper\Data\DataMapperInterface;
use Laventure\Component\Database\ORM\Mapper\Identity\IdentityMap;
use Laventure\Component\Database\ORM\Mapper\Identity\IdentityMapperInterface;
use Laventure\Component\Database\ORM\Mapping\ClassMetadataInterface;

/**
 * ObjectMapper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Manager\Data\Common
*/
abstract class ObjectMapper implements DataMapperInterface
{
    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;


    /**
     * @var IdentityMapperInterface
    */
    protected IdentityMapperInterface $identityMap;



    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em          = $em;
        $this->identityMap = new IdentityMap();
    }





    /**
     * @return IdentityMapperInterface
    */
    public function getIdentityMap(): IdentityMapperInterface
    {
        return $this->identityMap;
    }





    /**
     * @param $class
     * @param $id
     * @return string
    */
    public function getIdentityMapId($class, $id): string
    {
        return $this->em->getClassMetadata($class)
                        ->getIdentityMapId($id);
    }





    /**
     * @param $class
     * @param $id
     * @return bool
    */
    public function hasIdentityMapId($class, $id): bool
    {
        $identityMapId = $this->getIdentityMapId($class, $id);

        return $this->identityMap->has($identityMapId);
    }




    /**
     * @param $class
     * @param $id
     * @return mixed
    */
    public function load($class, $id): mixed
    {
        $identityMapId = $this->getIdentityMapId($class, $id);

        return $this->identityMap->get($identityMapId);
    }




    /**
     * @param object $object
     * @param int $id
     * @return mixed
    */
    public function map(int $id, object $object): int
    {
         $class  = get_class($object);

         $identityMapId = $this->getIdentityMapId($class, $id);

         $this->identityMap->map($identityMapId, $object);

         return $id;
    }






    /**
     * @param ObjectEvent $event
     * @return object
    */
    public function dispatchEvent(ObjectEvent $event): object
    {
        return $this->em->getEventManager()->dispatchEvent($event);
    }






    /**
     * @param string|object $class
     * @return Persistent
    */
    public function getPersistent(string|object $class): Persistent
    {
        return $this->em->getUnitOfWork()->getPersistent($class);
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





    /**
     * @param object $object
     * @param $id
     * @return object
    */
    public function findFromObject(object $object, $id): object
    {
        return $this->find(get_class($object), $id);
    }
}
