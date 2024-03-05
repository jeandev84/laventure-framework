<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Factory;

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
     * @return DatabaseManagerInterface
    */
    public function createDatabaseManager(): DatabaseManagerInterface;
}
