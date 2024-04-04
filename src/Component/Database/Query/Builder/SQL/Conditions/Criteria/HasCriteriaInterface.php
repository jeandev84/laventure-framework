<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria;

/**
 * HasCriteriaInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Conditions\Criteria
*/
interface HasCriteriaInterface
{
    /**
     * @param array $criteria
     * @return $this
    */
    public function criteria(array $criteria): static;
}
