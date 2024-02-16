<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types;

use Laventure\Component\Database\Schema\Constraints\Constraint;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;

/**
 * DefaultValue
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types
*/
class DefaultValue extends Constraint
{


    /**
     * @var string[]
    */
    protected array $constraints = [];



    /**
     * @param $value
     * @param bool $notNull
    */
    public function __construct(protected $value, bool $notNull = false)
    {
        if ($notNull === true) {
            $this->constraints(new NotNull());
        }

        parent::__construct('default');
    }




    /**
     * @param ConstraintInterface $constraint
     * @return $this
    */
    public function constraints(ConstraintInterface $constraint): static
    {
         $this->constraints[] = $constraint->getSQL();

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $sql = "DEFAULT $this->value";

        if ($this->constraints) {
            $sql = sprintf('DEFAULT "%s"%s', $this->value, $this->constraintsAsString());
        }

        return $sql;
    }




    /**
     * @return string
    */
    private function constraintsAsString(): string
    {
        return join(' ', $this->constraints);
    }
}
