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
    public function getConnection(): string
    {
        return $this->required('connection');
    }




    /**
     * @inheritdoc
    */
    public function getExtension(): string
    {
        return $this->required('extension');
    }




    /**
     * @inheritdoc
    */
    public function getCredentials(): ConfigurationInterface
    {
        return new Configuration($this->required('credentials'));
    }





    /**
     * @return array
    */
    public function getConnections(): array
    {
        return $this->required('connections');
    }
}
