<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
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
     * Returns PDO connection
     *
     * @param ConfigurationInterface $config
     * @return PDO
    */
    public function makePdo(ConfigurationInterface $config): PDO;







    /**
     * @param string $driver
     * @return bool
    */
    public function hasDriver(string $driver): bool;







    /**
     * Returns drivers
     *
     * @return array
    */
    public function getAvailableDrivers(): array;
}
