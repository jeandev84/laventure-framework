<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Option;

use Laventure\Component\Console\Input\Param\InputParamInterface;
use Laventure\Component\Console\Input\Rules\InputRulesInterface;

/**
 * InputOptionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\InputArgv\Option
*/
interface InputOptionInterface extends InputParamInterface, InputRulesInterface
{
    /**
     * @param $shortcut
     * @return $this
    */
    public function shortcut($shortcut): static;



    /**
     * @return string|null
    */
    public function getShortCut(): ?string;





    /**
     * @return string
    */
    public function getOptionsAsString(): string;
}
