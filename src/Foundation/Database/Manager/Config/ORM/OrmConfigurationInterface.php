<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config\ORM;

use Laventure\Foundation\Database\Manager\Config\Common\CommonConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\Mapper\MapperConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\ORM\Model\ModelConfigurationInterface;

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
     * Returns Data credentials
     *
     * @return MapperConfigurationInterface
    */
    public function mapper(): MapperConfigurationInterface;






    /**
     * Returns ActiveRecord credentials
     *
     * @return ModelConfigurationInterface
    */
    public function model(): ModelConfigurationInterface;
}
