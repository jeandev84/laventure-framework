<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Insert;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Decorator\SQLBuilderDecorator;
use Laventure\Component\Database\Query\Builder\SQL\Decorator\SQLBuilderDecoratorTrait;

/**
 * InsertBuilderDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\DML\PgsqlInsertBuilder
*/
class InsertBuilderDecorator extends SQLBuilderDecorator implements InsertBuilderInterface
{
      /**
       * @var InsertBuilderInterface
      */
      protected $builder;



      /**
       * @param InsertBuilderInterface $builder
      */
      public function __construct(InsertBuilderInterface $builder)
      {
          parent::__construct($builder);
      }



      /**
       * @inheritDoc
      */
      public function insert(string $table): static
      {
          $this->builder->insert($table);

          return $this;
      }



      /**
       * @inheritDoc
      */
      public function values(array $values): static
      {
          if ($this->hasMultiple($values)) {
              $this->addMultipleInsert($values);
          } else {
              $this->addInsert($values);
          }

          return $this;
      }





      /**
       * @inheritDoc
      */
      public function addMultipleInsert(array $values): static
      {
          $this->builder->addMultipleInsert($values);

          return $this;
      }





      /**
       * @inheritDoc
      */
      public function addInsert(array $attributes): static
      {
           $this->builder->addInsert($attributes);

           return $this;
      }




      /**
       * @inheritDoc
      */
      public function setValue(string $column, $value, int $index = 0): static
      {
          $this->builder->setValue($column, $value, $index);

          return $this;
      }





      /**
       * @inheritDoc
      */
      public function hasMultiple(array $values): bool
      {
         return $this->builder->hasMultiple($values);
      }
}