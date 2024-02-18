<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Types\Mysql;

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
 * @package  Laventure\Component\Database\Schema\Column\Types\Mysql
*/
class MysqlColumnFactory implements ColumnFactoryInterface
{

    /**
     * @inheritDoc
    */
    public function createColumn(
        string $name,
        string $type = '',
        string $constraints = ''
    ): ColumnInterface
    {
        return new MysqlColumn($name, $type, $constraints);
    }




    /**
     * @inheritDoc
    */
    public function createColumnFromInfo(ColumnInfoInterface $info): ColumnInterface
    {
        return $this->createColumn($info->getField(), $info->getType())
                    ->comments($info->getComment())
                    ->collation($info->getCollation())
                    ->withOptions([
                      'key'        => $info->getKey(),
                      'default'    => $info->getDefault(),
                      'privileges' => $info->getPrivileges()
                   ]);
    }
}