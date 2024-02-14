<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Drivers\Mysql;

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
     * @param string $name
     * @param string $type
     * @param string|null $constraint
    */
    public function __construct(string $name, string $type = '', string $constraint = null)
    {
        parent::__construct("`$name`", $type, $constraint);
    }



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
