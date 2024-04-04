<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\Migration\Types\Persistence;

use Laventure\Foundation\Loader\FilesDirectory\FilesDirectoryLoader;
use Laventure\Foundation\Loader\Migration\Types\AbstractMigrationLoader;

/**
 * PersistenceMigrationLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Migration\Data
*/
class PersistenceMigrationLoader extends AbstractMigrationLoader implements PersistenceMigrationLoaderInterface
{
    const PREFIX = 'database.orm.persistence.';

    /**
     * @inheritDoc
    */
    public function getPrefix(): string
    {
        return $this->config[self::PREFIX .'migrations.prefix'];
    }



    /**
     * @inheritDoc
     */
    public function getDirectory(): string
    {
        return $this->config[self::PREFIX .'migrations.dir'];
    }
}
