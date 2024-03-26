<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config\ORM\Model;

use Laventure\Component\Database\Manager\Config\ORM\Model\Migration\MigrationConfiguration;
use Laventure\Foundation\Database\Manager\Config\Common\Migration\MigrationConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\Model\Migration\ModelMigrationConfiguration;
use Laventure\Utils\Parameter\Parameter;

/**
 * ModelConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Config\ORM\ActiveRecord
 */
class ModelConfiguration extends Parameter implements ModelConfigurationInterface
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
    public function migrations(): MigrationConfigurationInterface
    {
        return new ModelMigrationConfiguration($this->required('migrations'));
    }
}
