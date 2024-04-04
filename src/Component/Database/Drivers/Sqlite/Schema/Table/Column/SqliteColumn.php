<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Sqlite\Schema\Table\Column;

use Laventure\Component\Database\Schema\Column\Column;

/**
 * SqliteColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\Sqlite
*/
class SqliteColumn extends Column
{
    /**
     * @inheritDoc
    */
    public function increment(): static
    {
        return $this->type('AUTOINCREMENT');
    }



    /**
     * @inheritDoc
    */
    public function modify(): static
    {
        return $this->name("MODIFY COLUMN $this->name");
    }
}
