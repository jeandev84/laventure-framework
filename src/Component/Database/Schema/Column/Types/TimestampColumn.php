<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Types;

/**
 * TimestampColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Types
*/
enum TimestampColumn: string
{
    case createdAt = 'created_at';
    case updatedAt = 'updated_at';
    case deletedAt = 'deleted_at';


    /**
     * @return string
    */
    public static function createdAt(): string
    {
        return self::createdAt->value;
    }




    /**
     * @return string
    */
    public static function updatedAt(): string
    {
        return self::updatedAt->value;
    }




    /**
     * @return string
    */
    public static function deletedAt(): string
    {
        return self::deletedAt->value;
    }

}
