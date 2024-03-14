<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Config\ORM\Mapper;

use Laventure\Component\Database\Manager\Config\Common\Migration\MigrationConfigurationInterface;
use Laventure\Component\Database\Manager\Config\ORM\Mapper\Entity\EntityConfigurationInterface;
use Laventure\Component\Database\Manager\Config\ORM\Mapper\Fixtures\FixturesConfigurationInterface;
use Laventure\Component\Database\Manager\Config\ORM\Mapper\Repository\EntityRepositoryConfigurationInterface;
use Laventure\Contract\Parameter\ParameterInterface;

/**
 * MapperConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Common
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
