<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Criteria;


use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;

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
       * @param SQLBuilder $builder
       * @return $this
      */
      public function withBuilder(SQLBuilder $builder): static;






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