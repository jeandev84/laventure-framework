<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table\Column;

use Laventure\Component\Database\Schema\Column\AbstractColumn;

/**
 * MysqlColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\Mysql
 */
class MysqlColumn extends AbstractColumn
{
    /**
     * @return $this
    */
    public function increment(): static
    {
        return $this->whereIncrement("AUTO_INCREMENT");
    }





    /**
     * @inheritDoc
    */
    public function signed(): static
    {
        return $this->withSign('SIGNED');
    }




    /**
     * @inheritDoc
    */
    public function unsigned(): static
    {
        return $this->withSign('UNSIGNED');
    }
}
