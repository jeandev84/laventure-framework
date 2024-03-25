<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Option\Exceptions;

use Laventure\Exceptions\BaseException;

/**
 * RequiredOptionException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Input\Option\Exception
 */
class RequiredOptionException extends BaseException
{
    /**
     * @param string $optionName
     * @param array $data
     * @param int $code
    */
    public function __construct(string $optionName, array $data = [], int $code = 409)
    {
        parent::__construct("Option name ($optionName) is required.", $data, $code);
    }
}
