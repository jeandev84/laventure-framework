<?php

declare(strict_types=1);

namespace Laventure\Component\Database;

use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * DatabaseFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database
 */
interface DatabaseFactoryInterface
{
    /**
     * @param string $name
     * @return DatabaseInterface
    */
    public function create(string $name): DatabaseInterface;
}
