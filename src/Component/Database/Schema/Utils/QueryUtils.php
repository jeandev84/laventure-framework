<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Utils;

/**
 * QueryUtils
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Utils
*/
class QueryUtils
{
      /**
       * @param array $queries
       * @return QueryCollection
      */
      public static function queries(array $queries): QueryCollection
      {
           return new QueryCollection($queries);
      }




      /**
       * @param array $queries
       * @return string
      */
      public static function str(array $queries): string
      {
          return static::queries($queries)->toString();
      }
}