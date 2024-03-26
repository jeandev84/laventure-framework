<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Service\Database\Connection;

use Laventure\Component\Database\Configuration\Exception\ConfigurationException;
use Laventure\Component\Database\Configuration\Exception\NotFoundConfigurationException;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Exception\NotFoundConnectionException;
use Laventure\Component\Database\Connection\Exception\UnavailableConnectionException;
use Laventure\Component\Database\Manager\Factory\DatabaseManagerFactory;
use PHPUnitTest\App\Service\Database\TestManager;

/**
 * PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service\PdoConnection
*/
class TestConnection
{
    /**
     * @param string $name
     * @return ConnectionInterface
     * @throws NotFoundConnectionException
     * @throws UnavailableConnectionException
     * @throws NotFoundConfigurationException
    */
    public static function make(string $name = 'mysql'): ConnectionInterface
    {
        return TestManager::make($name)->connection($name);
    }
}
