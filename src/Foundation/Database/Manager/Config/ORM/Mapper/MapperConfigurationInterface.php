<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config\ORM\Mapper;

use Laventure\Contract\Parameter\ParameterInterface;
use Laventure\Foundation\Database\Manager\Config\Common\Migration\MigrationConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Entity\EntityConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Fixtures\FixturesConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Repository\EntityRepositoryConfigurationInterface;

/**
 * MapperConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Common
 */
interface MapperConfigurationInterface extends ParameterInterface
{
    /**
     * @return EntityConfigurationInterface
    */
    public function entity(): EntityConfigurationInterface;


    /**
     * @return EntityRepositoryConfigurationInterface
    */
    public function repository(): EntityRepositoryConfigurationInterface;




    /**
     * @return FixturesConfigurationInterface
    */
    public function fixtures(): FixturesConfigurationInterface;




    /**
     * @return MigrationConfigurationInterface
    */
    public function migrations(): MigrationConfigurationInterface;
}
