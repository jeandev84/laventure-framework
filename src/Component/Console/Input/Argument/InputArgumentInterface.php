<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Argument;

use Laventure\Component\Console\Input\Param\InputParamInterface;
use Laventure\Component\Console\Input\Rules\InputRulesInterface;

/**
 * InputArgumentInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\InputArgv\Argument
 */
interface InputArgumentInterface extends InputParamInterface, InputRulesInterface
{
}
