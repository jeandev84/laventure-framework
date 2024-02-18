<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Contract;

use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;

/**
 * HasConstraintInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Contract
 */
interface HasConstraintInterface
{
    /**
     * Add constraint
     *
     * @param ConstraintInterface $constraint
     * @return $this
    */
    public function withConstraint(ConstraintInterface $constraint): static;




    /**
     * Add constraints
     *
     * @param ConstraintInterface[] $constraints
     * @return $this
    */
    public function withConstraints(array $constraints): static;







    /**
     * Determine if exist constraint name
     *
     * @param string $name
     * @return bool
    */
    public function hasConstraint(string $name): bool;








    /**
     * Returns constraints
     *
     * @return ConstraintInterface[]
    */
    public function getConstraints(): array;
}
