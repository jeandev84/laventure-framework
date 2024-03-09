<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Rules;

/**
 * InputRulesInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Input\Rules
*/
interface InputRulesInterface
{
    public const REQUIRED = 1;
    public const OPTIONAL = 2;


    /**
     * @return array
    */
    public function getRules(): array;



    /**
     * @param $rule
     * @return bool
    */
    public function hasRule($rule): bool;



    /**
     * @return bool
    */
    public function isRequired(): bool;




    /**
     * @return bool
    */
    public function isOptional(): bool;
}
