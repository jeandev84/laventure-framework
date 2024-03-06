<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderDecorator;

/**
 * PgsqlInsertBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DML
 */
class PdoInsertBuilder extends InsertBuilderDecorator
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

          #dd($this->builder->getCriteria()->toArray());

          return $this;
      }




      /**
       * @inheritdoc
      */
      public function addInsert(array $attributes, int $position = 0): static
      {
          foreach ($attributes as $column => $value) {
              $this->setValue($column, ":$column");
              $this->setParameter($column, $value);
          }

          dd($this->builder->getCriteria()->toArray());


          return $this;
      }

}