<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Factory;

use Laventure\Component\Database\Manager\Contract\DatabaseManagerInterface;
use Laventure\Component\Database\Manager\DatabaseManager;

/**
 * DatabaseManagerFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Factory
 */
class DatabaseManagerFactory implements DatabaseManagerFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createManager(array $connections = []): DatabaseManagerInterface
    {
        return new DatabaseManager($connections);
    }
}
