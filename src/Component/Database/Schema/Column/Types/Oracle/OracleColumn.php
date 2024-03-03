<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Types\Oracle;

use Laventure\Component\Database\Schema\Column\Column;

/**
 * OracleColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\Oracle
*/
class OracleColumn extends Column
{
    /**
     * @inheritDoc
    */
    public function increment(): static
    {
        return $this;
    }



    /**
     * @inheritDoc
    */
    public function modify(): static
    {
        return $this->name("MODIFY $this->name");
    }
}
