<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config\ORM\Mapper;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Foundation\Database\Manager\Config\Common\Migration\MigrationConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Entity\EntityConfiguration;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Entity\EntityConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Fixtures\FixturesConfiguration;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Fixtures\FixturesConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Migration\MapperMigrationConfiguration;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Repository\EntityRepositoryConfiguration;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Repository\EntityRepositoryConfigurationInterface;

/**
 * MapperConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Common
 */
class MapperConfiguration extends Configuration implements MapperConfigurationInterface
{
    /**
     * @inheritDoc
    */
    public function entity(): EntityConfigurationInterface
    {
        return new EntityConfiguration($this->required('entity'));
    }




    /**
     * @inheritDoc
    */
    public function repository(): EntityRepositoryConfigurationInterface
    {
        return new EntityRepositoryConfiguration($this->required('repository'));
    }




    /**
     * @inheritDoc
    */
    public function fixtures(): FixturesConfigurationInterface
    {
        return new FixturesConfiguration($this->required('fixtures'));
    }



    /**
     * @inheritDoc
    */
    public function migrations(): MigrationConfigurationInterface
    {
        return new MapperMigrationConfiguration($this->required('migrations'));
    }
}
