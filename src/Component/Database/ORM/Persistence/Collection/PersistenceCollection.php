<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Collection;

use Laventure\Component\Database\ORM\Persistence\Collection\Storage\ObjectCollectionInterface;

/**
 * PersistenceCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Collection
*/
class PersistenceCollection implements PersistenceCollectionInterface
{

    /**
     * @param string $assocName
     * @param ObjectCollectionInterface $collections
    */
    public function __construct(
        protected string $assocName,
        protected ObjectCollectionInterface $collections
    )
    {
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
    public function getCollection(): ObjectCollectionInterface
    {
        return $this->collections;
    }
}