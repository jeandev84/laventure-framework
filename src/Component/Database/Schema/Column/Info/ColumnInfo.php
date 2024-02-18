<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Info;

/**
 * ColumnInfo
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Info
*/
abstract class ColumnInfo implements ColumnInfoInterface
{
    /**
     * @param array $data
    */
    public function __construct(protected array $data)
    {
    }




    /**
     * @inheritdoc
    */
    public function get($id, $default = null): mixed
    {
        return $this->data[$id] ?? $default;
    }
}
