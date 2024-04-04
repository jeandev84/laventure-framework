<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli\Factory;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Factory\ConnectionFactoryInterface;
use mysqli;

/**
 * MysqliConnectionFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\Mysqli\Factory
 */
interface MysqliConnectionFactoryInterface extends ConnectionFactoryInterface
{
    /**
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $database
     * @param int|null $port
     * @param string|null $socket
     * @return mysqli
    */
    public function makeMysqli(
        string $hostname,
        string $username,
        string $password,
        string $database,
        ?int $port = null,
        ?string $socket = null
    ): mysqli;





    /**
     * @param ConfigurationInterface $config
     * @return mysqli
    */
    public function makeConnection(ConfigurationInterface $config): mysqli;
}
