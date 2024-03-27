<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Sqlite\Schema\Table\Column;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Factory\ColumnFactoryInterface;
use Laventure\Component\Database\Schema\Column\Info\ColumnInfoInterface;

/**
 * SqliteColumnFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\Sqlite
*/
class SqliteColumnFactory implements ColumnFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createColumn(string $name, string $type = '', string $constraints = ''): ColumnInterface
    {
        return new SqliteColumn($name, $type, $constraints);
    }




    /**
     * @inheritDoc
    */
    public function createColumnFromInfo(ColumnInfoInterface $info): ColumnInterface
    {
        return $this->createColumn(
            $info->getField(),
            $info->getType()
        );
    }
}
