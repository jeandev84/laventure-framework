<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Utils;

/**
 * QueryUtils
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Utils
*/
class QueryUtils
{
    /**
     * @param array $queries
     * @return QueryCollection
    */
    public static function collection(array $queries): QueryCollection
    {
        return new QueryCollection($queries);
    }




    /**
     * @param array $queries
     * @param string|null $separator
     * @return string
    */
    public static function str(array $queries, string $separator = null): string
    {
        return static::collection($queries)->separate($separator ?: ', ')->toString();
    }
}
