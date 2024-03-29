<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\Migration\Types\Mapper;

use Laventure\Foundation\Loader\FilesDirectory\FilesDirectoryLoader;
use Laventure\Foundation\Loader\Migration\Types\AbstractMigrationLoader;

/**
 * MapperMigrationLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Migration\DataMapper
*/
class MapperMigrationLoader extends AbstractMigrationLoader implements MapperMigrationLoaderInterface
{
    /**
     * @inheritDoc
    */
    public function getPrefix(): string
    {
        return $this->config['database.orm.mapper.migrations.prefix'];
    }



    /**
     * @inheritDoc
     */
    public function getDirectory(): string
    {
        return $this->config['database.orm.mapper.migrations.dir'];
    }
}
