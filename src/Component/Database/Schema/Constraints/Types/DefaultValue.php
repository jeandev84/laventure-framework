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
 * @package  Laventure\Component\Database\Schema\Constraints\Drivers
*/
class DefaultValue extends Constraint
{
    /**
     * @param $value
    */
    public function __construct(protected $value)
    {
        parent::__construct('default');
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return sprintf('DEFAULT %s', $this->value);
    }
}
