<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli\Factory;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Drivers\DriverException;
use mysqli;
use Throwable;

/**
 * MysqliConnectionFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\Mysqli\Factory
*/
class MysqliConnectionFactory implements MysqliConnectionFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function makeMysqli(
        string $hostname,
        string $username,
        string $password,
        string $database,
        ?int $port = null,
        ?string $socket = null
    ): mysqli {
        try {
            return new mysqli($hostname, $username, $password, $database, $port ?: 3306, $socket);
        } catch (Throwable $e) {
            throw new DriverException($e->getMessage(), [], 500);
        }
    }




    /**
     * @inheritDoc
    */
    public function makeConnection(ConfigurationInterface $config): mysqli
    {
        return $this->makeMysqli(
            $config->getHost(),
            $config->getUsername(),
            $config->getPassword(),
            $config->getDatabase(),
            $config->getPort(),
            $config->get('socket', '')
        );
    }
}
