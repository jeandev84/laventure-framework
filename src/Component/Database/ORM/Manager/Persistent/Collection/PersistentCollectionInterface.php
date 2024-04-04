<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Persistent\Collection;

use Laventure\Component\Database\ORM\Mapping\Association\Collection\CollectionAssociationFieldInterface;
use Laventure\Component\Database\ORM\Mapping\Association\Single\SingleAssociationFieldInterface;

/**
 * PersistentCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Collection
*/
interface PersistentCollectionInterface
{



       /**
        * @return CollectionAssociationFieldInterface[]
       */
       public function getCollectionAssociations(): array;




      /**
       * @return SingleAssociationFieldInterface[]
      */
      public function getSingleAssociations(): array;





      /**
       * @return $this
      */
      public function persistCollectionAssociations(int $associatedId): static;








      /**
       * @return $this
      */
      public function persistSingleAssociations(int $associatedId): static;





     /**
      * Refresh data
      *
      * @return object
     */
     public function refresh(): object;
}
