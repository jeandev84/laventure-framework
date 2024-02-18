<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Traits;


use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;

/**
 * HasConstraintTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Traits
*/
trait HasConstraintTrait
{

    /**
     * @var array
    */
    protected array $constraints = [];



    /**
     * Add constraint
     *
     * @param ConstraintInterface $constraint
     * @return $this
    */
    public function withConstraint(ConstraintInterface $constraint): static
    {
        $this->constraints[$constraint->getType()] = $constraint;

        return $this;
    }







    /**
     * Add constraints
     *
     * @param ConstraintInterface[] $constraints
     * @return $this
    */
    public function withConstraints(array $constraints): static
    {
        foreach ($constraints as $constraint) {
            $this->withConstraint($constraint);
        }

        return $this;
    }





    /**
     * @param string $name
     * @return bool
    */
    public function hasConstraint(string $name): bool
    {
        return isset($this->constraints[$name]);
    }






    /**
     * Returns constraints
     *
     * @return array
    */
    public function getConstraints(): array
    {
        return $this->constraints;
    }





    /**
     * @return string
    */
    public function getConstraintsAsString(): string
    {
        return join(' ', array_filter($this->constraints));
    }
}