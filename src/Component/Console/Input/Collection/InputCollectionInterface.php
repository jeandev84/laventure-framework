<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Collection;

use Laventure\Component\Console\Input\Argument\InputArgumentInterface;
use Laventure\Component\Console\Input\Option\InputOptionInterface;

/**
 * InputCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\InputArgv\Collection
*/
interface InputCollectionInterface
{
    /**
     * @return InputArgumentInterface[]
    */
    public function getArguments(): array;




    /**
     * @param $name
     * @return bool
    */
    public function hasArgument($name): bool;





    /**
     * @param $name
     * @return InputArgumentInterface|null
    */
    public function getArgument($name): ?InputArgumentInterface;






    /**
     * @return InputOptionInterface[]
    */
    public function getOptions(): array;







    /**
     * @param $name
     * @return bool
    */
    public function hasOption($name): bool;







    /**
     * @param $name
     * @return InputOptionInterface|null
    */
    public function getOption($name): ?InputOptionInterface;
}
