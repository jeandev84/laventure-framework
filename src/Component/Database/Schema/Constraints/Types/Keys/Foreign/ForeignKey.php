<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign;

use Laventure\Component\Database\Schema\Constraints\Constraint;
use Laventure\Component\Database\Schema\Constraints\Contract\ConstrainedInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;

/**
 * ForeignKey
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign
*/
class ForeignKey extends Constraint implements ForeignKeyInterface
{


    /**
     * @var ConstrainedInterface
    */
    protected ConstrainedInterface $constrained;




    /**
     * @var string
    */
    protected string $table;




    /**
     * @param string $column
     * @return $this
    */
    public function references(string $column): static
    {
         $this->columns[0] = $column;

         return $this;
    }






    /**
     * @param string $table
     * @return ConstrainedInterface
    */
    public function on(string $table): ConstrainedInterface
    {
        $this->table = $table;

        return $this->constrained();
    }







    /**
     * @return ConstrainedInterface
    */
    public function constrained(): ConstrainedInterface
    {
        return $this->constrained = new Constrained();
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return json_encode(get_object_vars($this));
    }
}
