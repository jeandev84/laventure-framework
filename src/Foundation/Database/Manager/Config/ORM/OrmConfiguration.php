<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config\ORM;

use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\MapperConfiguration;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\MapperConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\Model\ModelConfiguration;
use Laventure\Foundation\Database\Manager\Config\ORM\Model\ModelConfigurationInterface;
use Laventure\Utils\Parameter\Parameter;

/**
 * OrmConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Common
 */
class OrmConfiguration extends Parameter implements OrmConfigurationInterface
{
    /**
     * @inheritDoc
    */
    public function dir(): string
    {
        return $this->required('dir');
    }



    /**
     * @inheritDoc
    */
    public function prefix(): string
    {
        return $this->required('prefix');
    }




    /**
     * @inheritDoc
    */
    public function current(): string
    {
        return $this->required('current');
    }




    /**
     * @inheritDoc
    */
    public function mapper(): MapperConfigurationInterface
    {
        return new MapperConfiguration($this->required('mapper'));
    }





    /**
     * @inheritDoc
    */
    public function model(): ModelConfigurationInterface
    {
        return new ModelConfiguration($this->required('model'));
    }
}
