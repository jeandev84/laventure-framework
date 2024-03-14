<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Config\ORM;

use Laventure\Component\Database\Manager\Config\Common\CommonConfigurationInterface;
use Laventure\Component\Database\Manager\Config\ORM\Mapper\MapperConfigurationInterface;
use Laventure\Component\Database\Manager\Config\ORM\Model\ModelConfigurationInterface;

/**
 * OrmConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM
 */
interface OrmConfigurationInterface extends CommonConfigurationInterface
{

    /**
     * Returns name of current ORM
     *
     * @return string
    */
    public function current(): string;




    /**
     * Returns Mapper credentials
     *
     * @return MapperConfigurationInterface
    */
    public function mapper(): MapperConfigurationInterface;






    /**
     * Returns Model credentials
     *
     * @return ModelConfigurationInterface
    */
    public function model(): ModelConfigurationInterface;
}
