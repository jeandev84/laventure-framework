<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use PDO;

/**
 * PdoConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO
*/
interface PdoConnectionInterface
{

    /**
     * Connect to PDO
     *
     * @param ConfigurationInterface $config
     * @return mixed
    */
    public function connectToPdo(ConfigurationInterface $config): mixed;







    /**
     * Determine if the given name driver is available
     *
     * @param string $driver
     * @return bool
    */
    public function hasAvailableDriver(string $driver): bool;







    /**
     * Returns drivers
     *
     * @return array
    */
    public function getAvailableDrivers(): array;







    /**
     * Returns PDO connection
     *
     * @param ConfigurationInterface $config
     * @return PDO
    */
    public function makePdo(ConfigurationInterface $config): PDO;
}
