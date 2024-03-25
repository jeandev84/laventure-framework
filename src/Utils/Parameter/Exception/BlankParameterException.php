<?php

declare(strict_types=1);

namespace Laventure\Utils\Parameter\Exception;

use Laventure\Exceptions\BaseException;
use Throwable;

/**
 * BlankParameterException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Utils\Parameter\Exception
*/
class BlankParameterException extends BaseException
{
    public function __construct(string $key, array $data = [])
    {
        parent::__construct("'$key' is required param.", $data, 409);
    }
}
