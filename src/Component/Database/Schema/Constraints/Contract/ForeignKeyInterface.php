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
interface ForeignKeyInterface extends ConstraintInterface, ConstrainedInterface
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
     * @return string
    */
    public function getReferenceColumn(): string;






    /**
     * param string $referenceTable (Example: users)
     *
     * @param string $referenceTable
     * @return static
    */
    public function on(string $referenceTable): static;






    /**
     * @return string
    */
    public function getReferenceTable(): string;
}
