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
     * @param array $rules
     * @return $this
    */
    public function rules(array $rules): static;





    /**
     * @return $this
    */
    public function required(): static;





    /**
     * @return $this
    */
    public function optional(): static;






    /**
     * @return bool
    */
    public function isRequired(): bool;




    /**
     * @return bool
    */
    public function isOptional(): bool;
}
