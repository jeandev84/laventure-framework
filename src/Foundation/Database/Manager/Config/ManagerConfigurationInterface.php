<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Contract\Parameter\ParameterInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\OrmConfigurationInterface;

/**
 * ManagerConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Common
*/
interface ManagerConfigurationInterface extends ParameterInterface
{
    /**
     * Returns current connection name
     *
     * @return string
    */
    public function connection(): string;







    /**
     * Returns all connections credentials
     *
     * @return array
    */
    public function connections(): array;








    /**
     * @return OrmConfigurationInterface
    */
    public function orm(): OrmConfigurationInterface;
}
