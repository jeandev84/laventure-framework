<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Common\Collection;

use Laventure\Component\Database\ORM\Common\Collection\Contract\CollectionInterface;
use Laventure\Component\Database\ORM\Common\Storage\ObjectStorage;

/**
 * Collection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Common\Collection
*/
class Collection extends ObjectStorage implements CollectionInterface
{

    /**
     * @param object[] $items
    */
    public function __construct(array $items = [])
    {
        $this->addItems($items);
    }



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

    }




    /**
     * @inheritDoc
    */
    public function __unserialize(array $data): void
    {

    }




    /**
     * @param array $items
     * @return $this
    */
    private function addItems(array $items): static
    {
        foreach ($items as $item) {
            $this->add($item);
        }

        return $this;
    }
}
