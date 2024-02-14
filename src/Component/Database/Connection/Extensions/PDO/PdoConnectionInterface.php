<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;

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
interface PdoConnectionInterface extends ConnectionInterface
{
    /**
     * Returns PDO connection
     *
     * @return PDO
    */
    public function getPdo(): PDO;
}
