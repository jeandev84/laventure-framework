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
    case String         = 'string';
    case Text           = 'text';
    case BigInteger     = 'bigInteger';
    case Small          = 'smallInteger';
    case Binary         = 'binary';
    case Boolean        = 'boolean';
    case Decimal        = 'decimal';
    case Float          = 'float';
    case Guid           = 'guid';
    case Integer        = 'integer';
    case Json           = 'json';
    case Datetime       = 'datetime';
    case Timestamp      = 'timestamp';
    case Time           = 'time';





    /**
     * @return array
    */
    public function toArray(): array
    {
        return [];
    }
}
