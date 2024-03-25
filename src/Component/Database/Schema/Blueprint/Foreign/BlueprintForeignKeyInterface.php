<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint\Foreign;


use Laventure\Component\Database\Schema\Constraints\Contract\ConstrainedInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;

/**
 * BlueprintForeignKeyInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Blueprint\Foreign
*/
interface BlueprintForeignKeyInterface
{


    /**
     * @param string $referenceColumn
     * @return $this
    */
    public function references(string $referenceColumn): static;




    /**
     * @param string $referenceTable
     * @return ConstrainedInterface
    */
    public function on(string $referenceTable): ConstrainedInterface;




    /**
     * @return ConstrainedInterface
    */
    public function constrained(): ConstrainedInterface;
}