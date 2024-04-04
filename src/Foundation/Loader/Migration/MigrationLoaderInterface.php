<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\Migration;

use Laventure\Component\Database\Schema\Migration\MigrationInterface;
use Laventure\Foundation\Loader\FilesDirectory\FilesDirectoryLoaderInterface;

/**
 * MigrationLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Migration
*/
interface MigrationLoaderInterface extends FilesDirectoryLoaderInterface
{
    /**
     * @return MigrationInterface[]
    */
    public function loadMigrations(): array;
}
