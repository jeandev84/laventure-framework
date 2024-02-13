<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Conditions;


use Laventure\Component\Database\Builder\SQL\Conditions\Contract\BuilderConditionInterface;

/**
 * CriteriaResolverInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions
*/
interface CriteriaResolverInterface
{

     /**
      * @param array $criteria
      * @return CriteriaResolved
     */
     public function resolve(array $criteria): CriteriaResolved;
}