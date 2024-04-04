<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolved;

/**
 * CriteriaResolved
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Statement\Builder\SQL\Criteria
*/
class CriteriaResolved implements CriteriaResolvedInterface
{
    /**
     * @param mixed $condition
     * @param string $param
     * @param mixed $value
    */
    public function __construct(
        protected mixed $condition,
        protected string $param,
        protected mixed $value,
    ) {
    }



    /**
     * @inheritDoc
    */
    public function getParam(): string
    {
        return $this->param;
    }



    /**
     * @inheritDoc
    */
    public function getValue(): mixed
    {
        return $this->value;
    }




    /**
     * @inheritDoc
    */
    public function getCondition(): string
    {
        return strval($this->condition);
    }
}
