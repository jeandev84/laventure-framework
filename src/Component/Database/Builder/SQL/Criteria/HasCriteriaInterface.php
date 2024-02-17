<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Criteria;

/**
 * HasCriteriaInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Criteria
*/
interface HasCriteriaInterface
{
    /**
     * @return Criteria
    */
    public function getCriteria(): Criteria;
}
