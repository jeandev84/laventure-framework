<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolved;

/**
 * CriteriaResolvedInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Statement\Builder\SQL\Criteria
*/
interface CriteriaResolvedInterface
{
    /**
     * @return string
    */
    public function getParam(): string;




    /**
     * @return mixed
    */
    public function getValue(): mixed;





    /**
     * @return string
    */
    public function getCondition(): string;
}
