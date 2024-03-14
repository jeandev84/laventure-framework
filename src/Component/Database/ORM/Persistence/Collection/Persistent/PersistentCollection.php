<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Collection\Persistent;

use Laventure\Component\Database\ORM\Persistence\Collection\CollectionInterface;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;

/**
 * PersistentCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Mapper\Collection\Persistent
*/
class PersistentCollection implements PersistentCollectionInterface
{
    /**
     * @param string $assocName
     * @param CollectionInterface $collections
    */
    public function __construct(
        protected string $assocName,
        protected CollectionInterface $collections
    ) {
    }




    /**
     * @inheritDoc
    */
    public function getAssocName(): string
    {
        return $this->assocName;
    }





    /**
     * @inheritDoc
    */
    public function getCollection(): CollectionInterface
    {
        return $this->collections;
    }




    /**
     * @inheritDoc
    */
    public function persist(PersistentInterface $persistent): mixed
    {

    }
}
