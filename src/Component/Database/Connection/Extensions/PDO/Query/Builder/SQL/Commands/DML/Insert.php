<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderDecorator;

/**
 * Insert
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DML
 */
class Insert extends InsertBuilderDecorator
{

      /**
        * @inheritdoc
      */
      public function addMultipleInsert(array $values): static
      {
          foreach ($values as $position => $attributes) {
              foreach ($attributes as $column => $value) {
                  $this->setValue($column, ":{$column}_{$position}", $position);
                  $this->setParameter("{$column}_{$position}", $value);
              }
          }

          return $this;
      }




      /**
       * @inheritdoc
      */
      public function addInsert(array $attributes, int $index = 0): static
      {
          foreach ($attributes as $column => $value) {
              $this->setValue($column, ":$column", $index);
              $this->setParameter($column, $value);
          }

          return $this;
      }
}