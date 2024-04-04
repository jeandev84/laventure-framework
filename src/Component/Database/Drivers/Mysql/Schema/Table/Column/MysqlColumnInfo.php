<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql\Schema\Table\Column;

use Laventure\Component\Database\Schema\Column\Info\ColumnInfo;

/**
 * MysqlColumnInfo
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\Mysql
*/
class MysqlColumnInfo extends ColumnInfo
{
    /**
     * @inheritdoc
    */
    public function getField(): string
    {
        return $this->get('Field');
    }




    /**
     * @inheritdoc
    */
    public function getType(): string
    {
        return $this->get('Type');
    }





    /**
     * @inheritdoc
    */
    public function getCollation(): string
    {
        return $this->get('Collation', '');
    }





    /**
     * @inheritdoc
    */
    public function isNullable(): bool
    {
        $null = $this->get('Null');

        return $null === 'YES';
    }





    /**
     * @inheritdoc
    */
    public function getKey(): string
    {
        return $this->get('Key');
    }





    /**
     * @inheritdoc
    */
    public function getDefault(): mixed
    {
        return $this->get('Default');
    }





    /**
     * @inheritdoc
    */
    public function getExtra(): string
    {
        return $this->get('Extra');
    }





    /**
     * @inheritdoc
    */
    public function getPrivileges(): ?string
    {
        return $this->get('Privileges');
    }





    /**
     * @return string
    */
    public function getComment(): string
    {
        return $this->get('Comment');
    }
}
