<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Config;


use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;

/**
 * ManagerConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Config
*/
interface ManagerConfigurationInterface extends ConfigurationInterface
{
    /**
     * Returns current connection name
     *
     * @return string
    */
    public function getConnection(): string;




    /**
     * Returns current extension
     *
     * @return string
    */
    public function getExtension(): string;








    /**
     * Returns credentials current connection
     *
     * @return array
    */
    public function getCredentials(): array;
}