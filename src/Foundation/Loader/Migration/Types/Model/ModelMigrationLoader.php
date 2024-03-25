<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\Migration\Types\Model;

use Laventure\Foundation\Loader\Migration\Types\AbstractMigrationLoader;

/**
 * ModelMigrationLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Migration
 */
class ModelMigrationLoader extends AbstractMigrationLoader implements ModelMigrationLoaderInterface
{
    /**
     * @inheritDoc
    */
    public function getPrefix(): string
    {
        return $this->config['database.orm.model.migrations.prefix'];
    }



    /**
     * @inheritDoc
    */
    public function getDirectory(): string
    {
        return $this->config['database.orm.model.migrations.dir'];
    }
}
