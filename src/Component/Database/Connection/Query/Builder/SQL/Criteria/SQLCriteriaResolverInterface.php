<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Criteria;


/**
 * SQLCriteriaMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\Criteria
*/
interface SQLCriteriaResolverInterface
{


      /**
       * @param $column
       * @param array $value
       * @return mixed
      */
      public function resolveWhereIn($column, array $value): mixed;







      /**
       * @param $column
       * @param $value
       * @return mixed
      */
      public function resolveWhereEqualTo($column, $value): mixed;
}