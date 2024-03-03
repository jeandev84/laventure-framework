<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types;

/**
 * Nullable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Drivers
*/
class Nullable extends DefaultValue
{
    public function __construct()
    {
        parent::__construct("NULL");
    }
}
