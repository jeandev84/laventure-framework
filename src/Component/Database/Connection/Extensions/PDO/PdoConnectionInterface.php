<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory\PdoDsnBuilderFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilderInterface;
use PDO;

/**
 * PdoConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO
*/
interface PdoConnectionInterface extends ConnectionInterface
{
    /**
     * Returns PDO connection
     *
     * @param ConfigurationInterface $config
     * @return PDO
    */
    public function makePdo(ConfigurationInterface $config): PDO;





    /**
     * Returns PDO connection
     *
     * @return PDO
    */
    public function getConnection(): PDO;




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
     * @return PdoDsnBuilderInterface
    */
    public function getDsnBuilder(): PdoDsnBuilderInterface;










    /**
     * @return PdoDsnBuilderFactoryInterface
    */
    public function getPdoDsnBuilderFactory(): PdoDsnBuilderFactoryInterface;
}
