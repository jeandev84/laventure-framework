<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence;


/**
 * PersistentInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence
*/
interface PersistentInterface
{
      /**
       * @param $id
       * @return mixed
      */
      public function find($id): mixed;




      /**
       * @param $attributes
       * @return mixed
      */
      public function insert($attributes): mixed;




      /**
       * @param $attributes
       * @param $id
       * @return mixed
      */
      public function update($attributes, $id): mixed;





      /**
       * @param $id
       * @return mixed
      */
      public function delete($id): mixed;
}