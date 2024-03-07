<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Collection\Persistent;


use Laventure\Component\Database\ORM\Persistence\Collection\CollectionInterface;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;

/**
 * PersistentCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Collection
*/
interface PersistentCollectionInterface
{
     /**
      * @return string
     */
     public function getAssocName(): string;




     /**
      * @return CollectionInterface
     */
     public function getCollection(): CollectionInterface;





     /**
      * Persist collection
      *
      * @param PersistentInterface $persistent
      * @return mixed
     */
     public function persist(PersistentInterface $persistent): mixed;
}