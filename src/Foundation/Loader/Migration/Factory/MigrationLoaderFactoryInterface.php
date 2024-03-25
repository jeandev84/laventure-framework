<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\Migration\Factory;

use Laventure\Foundation\Loader\FilesDirectory\FilesDirectoryLoaderInterface;
use Laventure\Foundation\Loader\Migration\MigrationLoaderInterface;

/**
 * MigrationLoaderFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Migration
 */
interface MigrationLoaderFactoryInterface
{
    /**
     * @param string $type
     * @return MigrationLoaderInterface
    */
    public function createMigrationLoader(
        string $type
    ): MigrationLoaderInterface;
}
