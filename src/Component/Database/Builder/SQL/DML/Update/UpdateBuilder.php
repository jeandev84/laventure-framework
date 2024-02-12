<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Update;

use Laventure\Component\Database\Builder\SQL\Conditions\BuilderConditionTrait;
use Laventure\Component\Database\Builder\SQL\Expr\Set;
use Laventure\Component\Database\Builder\SQL\Expr\Update;
use Laventure\Component\Database\Builder\SQL\Expr\Where;

/**
 * UpdateBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Update
*/
class UpdateBuilder implements UpdateBuilderInterface
{

      use BuilderConditionTrait;


     /**
      * @inheritDoc
     */
     public function update(string $table, string $alias = ''): static
     {
         $this->criteria->table($table, $alias);

         return $this;
     }




     /**
      * @inheritDoc
     */
     public function set($column, $value): static
     {
         $this->criteria->set[$column] = "$column = $value";

         return $this;
     }






     /**
      * @inheritDoc
     */
     public function getSQL(): string
     {
         return $this->formatter->addFormats([
             new Update($this->criteria->table),
             new Set($this->criteria->set),
             $this->getWhere()
         ])->format();
     }
}