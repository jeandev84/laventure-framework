<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types;

use Laventure\Component\Database\Schema\Constraints\Constraint;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\HasConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Traits\HasConstraintTrait;

/**
 * DefaultValue
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Drivers
*/
class DefaultValue extends Constraint implements HasConstraintInterface
{
    use HasConstraintTrait;



    /**
     * @param $value
     * @param bool $notNull
    */
    public function __construct(protected $value, bool $notNull = false)
    {
        if ($notNull === true) {
            $this->withConstraint(new NotNull());
        }

        parent::__construct('default');
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $sql = "DEFAULT $this->value";

        if ($this->constraints) {
            $sql = sprintf(
                'DEFAULT "%s"%s',
                $this->value,
                $this->getConstraintsAsString()
            );
        }

        return $sql;
    }
}
