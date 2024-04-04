<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Migration;

use Laventure\Foundation\Database\Manager\Config\Common\Migration\MigrationConfigurationInterface;
use Laventure\Utils\Parameter\Parameter;

/**
 * MigrationConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Config\ORM\Data\Migration
*/
class MapperMigrationConfiguration extends Parameter implements MigrationConfigurationInterface
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
    public function version(): string
    {
        return $this->required('version');
    }



    /**
     * @inheritDoc
     */
    public function prefix(): string
    {
        return $this->required('prefix');
    }
}
