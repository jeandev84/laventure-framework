<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Command\Exception;

use Throwable;

/**
 * UnavailableCommandParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Command\Exception
 */
class GeneratorCommandParamsException extends CommandGeneratorException
{
    public function __construct(string $message, array $data = [], int $code = 400)
    {
        parent::__construct($message, $data, $code);
    }
}
