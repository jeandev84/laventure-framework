<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint\Foreign;


use Laventure\Component\Database\Schema\Constraints\Contract\ConstrainedInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * BlueprintForeignKey
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Blueprint\Foreign
*/
class BlueprintForeignKey implements BlueprintForeignKeyInterface
{


    /**
     * @param TableInterface $table
     * @param ForeignKeyInterface $foreignKey
    */
    public function __construct(
        protected TableInterface $table,
        protected ForeignKeyInterface $foreignKey
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function references(string $referenceColumn): static
    {
         $this->foreignKey->references($referenceColumn);

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function on(string $referenceTable): ConstrainedInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function constrained(): ConstrainedInterface
    {

    }
}