<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Collection;


use Laventure\Component\Database\ORM\Persistence\Collection\Storage\ObjectCollectionInterface;

/**
 * PersistenceCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Collection
*/
interface PersistenceCollectionInterface
{
     /**
      * @return string
     */
     public function getAssocName(): string;




     /**
      * @return ObjectCollectionInterface
     */
     public function getCollection(): ObjectCollectionInterface;
}