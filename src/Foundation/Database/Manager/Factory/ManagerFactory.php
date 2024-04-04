<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Factory;

use Laventure\Foundation\Database\Manager\Manager;
use Laventure\Foundation\Database\Manager\ManagerInterface;

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
