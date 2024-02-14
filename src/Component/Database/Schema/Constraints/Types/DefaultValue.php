<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types;

use Laventure\Component\Database\Schema\Constraints\Constraint;

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
     * @param $value
     * @param bool $notNull
    */
    public function __construct(protected $value, protected bool $notNull = false)
    {
        parent::__construct('default');
    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        if ($this->notNull === true) {
            return sprintf('DEFAULT "%s" NOT NULL', $this->value);
        }

        return "DEFAULT $this->value";
    }
}
