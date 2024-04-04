<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input;

use Laventure\Component\Console\Input\Collection\InputCollectionInterface;
use Stringable;

/**
 * InputInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\InputArgv\Contract
*/
interface InputInterface extends Stringable
{
    /**
     * Parse input tokens
     *
     * This  method implements setting arguments, options, flags ...
     *
     * @param array $tokens
     * @return void
    */
    public function parseTokens(array $tokens): void;






    /**
     * Return all inputs parsed
     *
     * Example : $tokens = [arg0, arg1, arg2, option0, option1, flag0, flag1 ...]
     *
     * @return array
    */
    public function getTokens(): array;







    /**
     * Return  first parsed argument
     *
     * Example: php console arg0
     *
     * @return mixed
    */
    public function getFirstArgument(): mixed;








    /**
     * Return given name argument or default argument.
     *
     * @param $name
     * @return mixed
     */
    public function getArgument($name = null): mixed;





    /**
     * Determine if the given argument name exist.
     *
     * @param $name
     * @return bool
    */
    public function hasArgument($name): bool;






    /**
     * Return all parses arguments
     *
     * @return array
    */
    public function getArguments(): array;






    /**
     * Return parsed option
     *
     *
     * @param $name
     * @return mixed
    */
    public function getOption($name): mixed;







    /**
     * Determine if the given option name exist.
     *
     *
     * @param $name
     * @return bool
    */
    public function hasOption($name): bool;







    /**
     * Return all parsed options
     *
     *
     * @return array
    */
    public function getOptions(): array;






    /**
     * Count inputs
     *
     * @return int
    */
    public function count(): int;






    /**
     *  Validate parsed inputs
     *
     * @param InputCollectionInterface $inputs
     * @return mixed
    */
    public function validate(InputCollectionInterface $inputs): mixed;
}
