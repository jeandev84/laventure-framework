<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Factory;

use Laventure\Component\Database\Manager\Contract\ManagerInterface;
use Laventure\Component\Database\Manager\Factory\Contract\ManagerFactoryInterface;
use Laventure\Component\Database\Manager\Manager;

/**
 * ManagerFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Factory
*/
class ManagerFactory implements ManagerFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createManager(): ManagerInterface
    {
        return new Manager();
    }
}
