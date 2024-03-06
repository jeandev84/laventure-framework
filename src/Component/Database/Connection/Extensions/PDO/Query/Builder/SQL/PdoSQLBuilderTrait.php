<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL;


use Laventure\Component\Database\Query\Builder\SQL\Decorator\SQLBuilderDecoratorTrait;


/**
 * PdoSQLBuilderTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Query\Builder\SQL
*/
trait PdoSQLBuilderTrait
{
     use SQLBuilderDecoratorTrait;


     /**
      * @inheritdoc
     */
     public function set($column, $value): static
     {
         $this->set($column, ":$column");
         $this->setParameter($column, $value);

         return $this;
     }


     /**
      * @inheritdoc
     */
     public function whereIn($column, array $value): static
     {
         $this->andWhere($this->expr()->in($column, ":$column"));
         $this->setParameter($column, $value);

         return $this;
     }




     /**
      * @inheritdoc
     */
     public function whereEqualTo($column, $value): static
     {
         $this->andWhere($this->expr()->eq($column, ":$column"));
         $this->setParameter($column, $value);

         return $this;
     }
}