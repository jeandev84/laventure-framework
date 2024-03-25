<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Utils;

/**
 * QueryStringify
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Utils
*/
class QueryStringify
{
      /**
       * @param array $queries
       * @return QueryCollection
      */
      public static function queries(array $queries): QueryCollection
      {
           return new QueryCollection($queries);
      }
}