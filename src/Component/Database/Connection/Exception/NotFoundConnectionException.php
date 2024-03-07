<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Exception;

use Laventure\Exceptions\BaseException;
use Throwable;

/**
 * NotFoundConnectionException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Exception
*/
class NotFoundConnectionException extends BaseException
{
    public function __construct(string $connection = "", array $data = [], ?Throwable $previous = null)
    {
        parent::__construct("Not found connection '$connection'", $data, 404, $previous);
    }
}
