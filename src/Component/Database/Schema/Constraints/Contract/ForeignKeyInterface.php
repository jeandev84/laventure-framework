<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Contract;

use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;

/**
 * ForeignKeyInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Contract
 */
interface ForeignKeyInterface extends ConstraintInterface
{


    /**
     * Returns foreign column name
     *
     * @return string
    */
    public function getColumn(): string;




    /**
     * @param string $referenceColumn (Example: id)
     * @return $this
    */
    public function references(string $referenceColumn): static;





    /**
     * param string $referenceTable (Example: users)
     *
     * @param string $referenceTable
     * @return ConstrainedInterface
    */
    public function on(string $referenceTable): ConstrainedInterface;






    /**
     * @return ConstrainedInterface
    */
    public function constrained(): ConstrainedInterface;
}
