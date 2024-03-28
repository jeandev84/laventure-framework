<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers;

use Laventure\Component\Database\Configuration\Configuration;

/**
 * DriverConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers
*/
class DriverConfiguration extends Configuration
{
    protected array $params = [
        'driver'     =>  null,
        'database'   =>  null,
        'host'       =>  null,
        'port'       =>  null,
        'username'   =>  null,
        'password'   =>  null,
        'collation'  =>  null,
        'charset'    =>  null,
        'prefix'     =>  null,
        'engine'     =>  null,
        'options'    => []
    ];
}
