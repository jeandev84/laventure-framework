<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table\Column;

use Laventure\Component\Database\Schema\Column\Column;

/**
 * MysqlColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\Mysql
 */
class MysqlColumn extends Column
{
    /**
     * @inheritDoc
    */
    public function increment(): static
    {
        return $this->type("AUTO_INCREMENT");
    }




    /**
     * @inheritDoc
    */
    public function modify(): static
    {
        return $this->name("MODIFY COLUMN $this->name");
    }
}
