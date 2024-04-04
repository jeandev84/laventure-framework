<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Option;

/**
 * ConsoleOptionStatusInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console
 */
interface OptionStatusInterface
{
    /**
     * @param $name
     * @return bool
    */
    public function hasVersion($name): bool;




    /**
     * @param $name
     * @return bool
    */
    public function hasHelp($name): bool;






    /**
     * @param $name
     * @return bool
    */
    public function hasQuiet($name): bool;





    /**
     * @param $name
     * @return bool
    */
    public function hasNoInteraction($name): bool;




    /**
     * @param $name
     * @return bool
    */
    public function hasEnvironment($name): bool;




    /**
     * @param $name
     * @return bool
    */
    public function hasNoDebug($name): bool;




    /**
     * @param $name
     * @return bool
    */
    public function hasVerbose($name): bool;
}
