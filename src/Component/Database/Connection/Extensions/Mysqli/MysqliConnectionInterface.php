<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use mysqli;

/**
 * MysqliConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\Mysqli
*/
interface MysqliConnectionInterface extends ConnectionInterface
{
    /**
     * @param ConfigurationInterface $config
     * @return mysqli
    */
    public function makeMysqli(ConfigurationInterface $config): mysqli;





    public function getConnection(): mysqli;
}
