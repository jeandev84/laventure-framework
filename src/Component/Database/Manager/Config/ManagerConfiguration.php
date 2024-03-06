<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Config;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Utils\Parameter\Parameter;

/**
 * ManagerConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\Definition
*/
class ManagerConfiguration extends Parameter implements ManagerConfigurationInterface
{
    /**
     * @inheritdoc
    */
    public function connectionType(): string
    {
        return $this->required('connection');
    }






    /**
     * @inheritdoc
    */
    public function credentials(): ConfigurationInterface
    {
        return new Configuration(
            $this->connections()[$this->connectionType()]
        );
    }





    /**
     * @return array
    */
    public function connections(): array
    {
        return $this->required('connections');
    }
}
