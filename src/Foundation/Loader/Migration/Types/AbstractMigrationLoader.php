<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\Migration\Types;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Database\Schema\Migration\MigrationInterface;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Foundation\Loader\FilesDirectory\FilesDirectoryLoader;
use Laventure\Foundation\Loader\Migration\MigrationLoaderInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * AbstractMigrationLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Migration\Type
 */
abstract class AbstractMigrationLoader extends FilesDirectoryLoader implements MigrationLoaderInterface
{
    /**
     * @param ContainerInterface $app
     * @param Filesystem $filesystem
     * @param ConfigInterface $config
    */
    public function __construct(
        protected ContainerInterface $app,
        Filesystem $filesystem,
        ConfigInterface $config
    ) {
        parent::__construct($filesystem, $config);
    }




    /**
      * @return MigrationInterface[]
      * @throws ContainerExceptionInterface
      * @throws NotFoundExceptionInterface
    */
    public function loadMigrations(): array
    {
        $migrations = [];

        foreach ($this->load() as $migration) {
            $migration = $this->app->get($migration);
            if (!$migration instanceof MigrationInterface) {
                continue;
            }
            $migrations[] = $migration;
        }
        return $migrations;
    }
}
