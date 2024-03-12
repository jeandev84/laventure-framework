<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Command\Exception;

/**
 * UnavailableCommandParamsException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Command\Exception
*/
class UnavailableCommandParamsException extends GeneratorCommandParamsException
{
    public function __construct(string $classname)
    {
        parent::__construct("Unavailable command names from method class ($classname)", [
            'context' => $classname . " has not command name params detected."
        ], 409);
    }
}
