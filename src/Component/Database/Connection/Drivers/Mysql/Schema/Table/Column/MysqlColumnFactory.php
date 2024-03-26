<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table\Column;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Factory\ColumnFactoryInterface;
use Laventure\Contract\Parameter\ParameterInterface;
use Laventure\Utils\Parameter\Parameter;

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
    public function createColumn(string $name): ColumnInterface
    {
        return new MysqlColumn($name);
    }




    /**
     * @inheritDoc
    */
    public function createFromArray(array $data): ColumnInterface
    {
        return $this->createFromParameter(new Parameter($data));
    }





    /**
     * @inheritDoc
    */
    public function createFromParameter(ParameterInterface $parameter): ColumnInterface
    {
        $columnName = $parameter->string('Field');

        return $this->createColumn($columnName)
                    ->type($parameter->string('Type'))
                    ->collation($parameter->string('Collation'))
                    ->isNull($parameter->toLower('Null'))
                    ->key($parameter->string('Key'))
                    ->defaultValue($parameter->get('Default'))
                    ->extra($parameter->string('Extra'))
                    ->privileges($parameter->string('Privileges'))
                    ->comments($parameter->string('Comments'));
    }
}
