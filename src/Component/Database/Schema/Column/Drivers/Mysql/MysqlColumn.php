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
    */
    public function __construct(string $name, string $type)
    {
        parent::__construct("`$name`", $type);
    }



    /**
     * @inheritDoc
    */
    public function increment(): static
    {
       $this->type .= " AUTO_INCREMENT";

       return $this;
    }
}
