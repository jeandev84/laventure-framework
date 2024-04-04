<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Argument\Exceptions;

/**
 * RequiredArgumentException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Input\Argument
*/
class RequiredArgumentException extends InputArgumentException
{
    /**
     * @param string $argumentName
     * @param array $data
     * @param int $code
    */
    public function __construct(string $argumentName, array $data = [], int $code = 409)
    {
        parent::__construct("Argument <$argumentName> is required.", $data, $code);
    }
}
