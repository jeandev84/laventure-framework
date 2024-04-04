<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Factory;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Manager\Contract\DatabaseManagerInterface;

/**
 * DatabaseManagerFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager
*/
interface DatabaseManagerFactoryInterface
{
    /**
     * Create database manager
     *
     * @param ConnectionInterface[] $connections
     * @return DatabaseManagerInterface
    */
    public function createManager(array $connections = []): DatabaseManagerInterface;
}
