<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config\ORM\Model;

use Laventure\Foundation\Database\Manager\Config\Common\CommonConfigurationInterface;
use Laventure\Foundation\Database\Manager\Config\Common\Migration\MigrationConfigurationInterface;

/**
 * ModelConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Config\ORM\ActiveRecord
 */
interface ModelConfigurationInterface extends CommonConfigurationInterface
{
    /**
     * @return MigrationConfigurationInterface
    */
    public function migrations(): MigrationConfigurationInterface;
}
