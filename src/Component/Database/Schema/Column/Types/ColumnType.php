<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Types;

/**
 * ColumnType
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Types
*/
enum ColumnType: string
{
    case STRING         = 'string';
    case TEXT           = 'text';
    case BIGINT         = 'bigint';
    case BINARY         = 'binary';
    case BOOLEAN        = 'boolean';
    case DECIMAL        = 'decimal';
    case FLOAT          = 'float';
    case GUID           = 'guid';
    case INTEGER        = 'integer';
    case JSON           = 'json';
    case SMALLINT       = 'smallint';
    case TIME_MUTABLE   = 'time';





    /**
     * @return array
    */
    public function toArray(): array
    {
        return [];
    }
}
