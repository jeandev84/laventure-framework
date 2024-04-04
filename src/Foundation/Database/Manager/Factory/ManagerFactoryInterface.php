<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Factory;

use Laventure\Foundation\Database\Manager\ManagerInterface;

/**
 * ManagerFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Factory
*/
interface ManagerFactoryInterface
{
    /**
     * Create manager
     *
     * @return ManagerInterface
    */
    public function createManager(): ManagerInterface;
}
