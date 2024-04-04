<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\OrmConfiguration;
use Laventure\Foundation\Database\Manager\Config\ORM\OrmConfigurationInterface;
use Laventure\Utils\Parameter\Exception\BlankParameterException;
use Laventure\Utils\Parameter\Parameter;

/**
 * ManagerConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\Config
*/
class ManagerConfiguration extends Parameter implements ManagerConfigurationInterface
{
    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        parent::__construct($params);
    }



    /**
     * @inheritdoc
    */
    public function connection(): string
    {
        return $this->required('connection');
    }





    /**
     * @inheritdoc
     * @throws BlankParameterException
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
