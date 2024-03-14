<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Config;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Name\ConnectionName;
use Laventure\Component\Database\Manager\Config\ORM\OrmConfiguration;
use Laventure\Component\Database\Manager\Config\ORM\OrmConfigurationInterface;
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
    public function connection(): string
    {
        return $this->required('connection');
    }





    /**
     * @inheritdoc
    */
    public function credentials(): ConfigurationInterface
    {
        return new Configuration(
            $this->connections()[$this->connection()]
        );
    }





    /**
     * @inheritdoc
    */
    public function connections(): array
    {
        return $this->required('connections');
    }





    /**
     * @inheritDoc
    */
    public function orm(): OrmConfigurationInterface
    {
        return new OrmConfiguration($this->required('orm'));
    }
}
