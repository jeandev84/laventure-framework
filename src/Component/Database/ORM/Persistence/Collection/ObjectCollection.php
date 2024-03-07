<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Collection;

use Laventure\Component\Database\ORM\Persistence\Storage\ObjectStorage;

/**
 * ObjectCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\ObjectCollection
*/
class ObjectCollection extends ObjectStorage implements ObjectCollectionInterface
{

    /**
     * @inheritDoc
    */
    public function add(object $object): static
    {
        if (!$this->contains($object)) {
            $this->attach($object);
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function remove(object $object): static
    {
        if ($this->contains($object)) {
            $this->detach($object);
        }

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function __serialize(): array
    {
         // TODO implements
    }




    /**
     * @inheritDoc
    */
    public function __unserialize(array $data): void
    {
         //TODO implements
    }
}