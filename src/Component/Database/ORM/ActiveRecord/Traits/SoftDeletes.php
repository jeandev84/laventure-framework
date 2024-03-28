<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Traits;

use Laventure\Component\Database\Schema\Column\Types\TimestampColumn;

/**
 * SoftDeletes
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Traits
 */
trait SoftDeletes
{
      /**
       * @var array
      */
      protected $softDeletes = [];



      /**
       * @return string[]
      */
      public function getSoftDeleteTimestamps(): array
      {

          if (empty($this->softDeletes)) {
             $this->softDeletes = [TimestampColumn::deletedAt()];
          }

          $softDeletes = [];

          foreach ($this->softDeletes as $column) {
              $softDeletes[$column] = date('Y-m-d H:i:s');
          }

          return $softDeletes;
     }
}