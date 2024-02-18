<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager;

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
     * @param array $connections
     * @return DatabaseManagerInterface
    */
    public function createDatabaseManager(
        array $connections = []
    ): DatabaseManagerInterface;
}
