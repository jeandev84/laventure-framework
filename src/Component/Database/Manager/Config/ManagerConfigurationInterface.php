<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Config;


use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Contract\Parameter\ParameterInterface;

/**
 * ManagerConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Config
*/
interface ManagerConfigurationInterface extends ParameterInterface
{
    /**
     * Returns current connection name
     *
     * @return string
    */
    public function connectionType(): string;







    /**
     * Returns credentials current connection
     *
     * @return ConfigurationInterface
    */
    public function credentials(): ConfigurationInterface;







    /**
     * Returns all connections credentials
     *
     * @return array
    */
    public function connections(): array;
}