<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers;

/**
 * UnavailableDriverException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers
 */
class UnavailableDriverException extends DriverException
{
    /**
     * @param string $driver
     * @param array $data
    */
    public function __construct(string $driver, array $data = [])
    {
        parent::__construct("Unavailable driver $driver on your system", $data, 400);
    }
}
