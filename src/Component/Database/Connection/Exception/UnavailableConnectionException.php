<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Exception;

use Laventure\Exceptions\BaseException;
use Throwable;

/**
 * UnavailableConnectionException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Exception
*/
class UnavailableConnectionException extends BaseException
{
    /**
     * @param string $connection
     * @param array $data
     * @param Throwable|null $previous
    */
    public function __construct(string $connection = "", array $data = [], ?Throwable $previous = null)
    {
        parent::__construct("Unavailable connection '$connection'", $data, 503, $previous);
    }
}
