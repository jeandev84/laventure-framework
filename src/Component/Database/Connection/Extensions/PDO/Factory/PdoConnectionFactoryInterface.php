<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Factory;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Factory\ConnectionFactoryInterface;
use PDO;

/**
 * PdoFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Factory
*/
interface PdoConnectionFactoryInterface extends ConnectionFactoryInterface
{
    /**
     * @param string $dsn
     * @param string|null $username
     * @param string|null $password
     * @param array $options
     * @return PDO
    */
    public function makePdo(
        string $dsn,
        string $username = null,
        string $password = null,
        array $options   = []
    ): PDO;




    /**
     * @param ConfigurationInterface $config
     * @return PDO
    */
    public function makeConnection(ConfigurationInterface $config): PDO;
}
