<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table\Column;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Factory\ColumnFactoryInterface;
use Laventure\Component\Database\Schema\Column\Info\ColumnInfoInterface;

/**
 * MysqlColumnFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\Mysql
*/
class MysqlColumnFactory implements ColumnFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createColumn(
        string $name,
        string $type,
        array $options = []
    ): ColumnInterface {
        return new MysqlColumn("`$name`", $type, $options);
    }
}
