<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types;

use Laventure\Component\Database\Schema\Constraints\Constraint;

/**
 * NotNull
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Schema\Constraints\Drivers
*/
class NotNull extends Constraint
{
    public function __construct()
    {
        parent::__construct('notNull');
    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return "NOT NULL";
    }
}
