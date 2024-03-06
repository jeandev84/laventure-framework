<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\SqlServer\Schema\Column;

use Laventure\Component\Database\Schema\Column\Column;

/**
 * SQlServerColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\SqlServer
*/
class SQlServerColumn extends Column
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
        return $this->name("ALTER COLUMN $this->name");
    }
}
