<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapper\Data;

use Laventure\Component\Database\ORM\Persistence\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;

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
     * @var PersistentInterface
    */
    protected PersistentInterface $persistent;


    /**
     * @var EventManagerInterface
    */
    protected EventManagerInterface $eventManager;




    /**
     * @param PersistentInterface $persistent
     * @param EventManagerInterface $eventManager
    */
    public function __construct(
       PersistentInterface $persistent,
       EventManagerInterface $eventManager
    )
    {
        $this->persistent = $persistent;
        $this->eventManager = $eventManager;
    }




    /**
     * @inheritDoc
    */
    public function find($id): ?object
    {
        return $this->persistent->find($id);
    }






    /**
     * @inheritDoc
    */
    public function save(object $object): int
    {

    }




    /**
     * @inheritDoc
    */
    public function delete(object $object): bool
    {

    }





    /**
     * @param object $object
     * @return int
    */
    public function insert(object $object): int
    {

    }





    /**
     * @param object $object
     * @return mixed
    */
    public function update(object $object): mixed
    {

    }
}