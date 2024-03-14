<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Factory\Contract;


use Laventure\Component\Database\Manager\Contract\ManagerInterface;

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