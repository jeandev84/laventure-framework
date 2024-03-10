<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Argument;

use Laventure\Component\Console\Input\Param\InputParam;

/**
 * InputArgument
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\InputArgv\Argument
*/
class InputArgument extends InputParam implements InputArgumentInterface
{
    public const REQUIRED = 2;
    public const OPTIONAL = 3;



    /**
     * @inheritDoc
    */
    public function readAsString(): string
    {
        return sprintf('%s %s', $this->name, $this->description);
    }
}
