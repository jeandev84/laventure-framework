<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config\Common\Migration;

use Laventure\Foundation\Database\Manager\Config\Common\CommonConfigurationInterface;

/**
 * MigrationConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Config\ORM\Data\Migration
 */
interface MigrationConfigurationInterface extends CommonConfigurationInterface
{
    /**
     * @return string
    */
    public function version(): string;
}
