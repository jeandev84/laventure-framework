<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\Migration\Factory;

use Laventure\Foundation\Database\ORM\Enum\OrmType;
use Laventure\Foundation\Loader\Migration\Exception\MigrationLoaderException;
use Laventure\Foundation\Loader\Migration\MigrationLoaderInterface;
use Laventure\Foundation\Loader\Migration\Types\Persistence\PersistenceMigrationLoader;
use Laventure\Foundation\Loader\Migration\Types\Model\ModelMigrationLoader;
use Psr\Container\ContainerInterface;

/**
 * MigrationLoaderFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Migration
*/
class MigrationLoaderFactory implements MigrationLoaderFactoryInterface
{
    /**
     * @param ContainerInterface $app
    */
    public function __construct(protected ContainerInterface $app) {
    }



    /**
     * @inheritDoc
    */
    public function createMigrationLoader(string $type): MigrationLoaderInterface
    {
        return match ($type) {
            OrmType::Persistence => $this->app->get(PersistenceMigrationLoader::class),
            OrmType::Model       => $this->app->get(ModelMigrationLoader::class),
            default              => new MigrationLoaderException("Unavailable migration loader given type ($type)")
        };
    }
}
