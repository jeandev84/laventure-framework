<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Conditions\Resolver;

/**
 * ConditionResolverInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions\Resolver
*/
interface CriteriaResolverInterface
{
    /**
     * @param array $criteria
     * @return mixed
    */
    public function resolve(array $criteria): mixed;
}
