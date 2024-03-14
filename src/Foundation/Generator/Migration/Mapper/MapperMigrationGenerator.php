<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Migration\Mapper;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Foundation\Application;
use Laventure\Foundation\Generator\Migration\Exception\MigrationGeneratorException;
use Laventure\Foundation\Generator\Migration\MigrationFileGenerator;

/**
 * PersistenceMigrationGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Migration
 */
class MapperMigrationGenerator extends MigrationFileGenerator
{


    /**
     * @param Application $app
     * @param FilesystemInterface $filesystem
     * @param ConfigInterface $config
    */
    public function __construct(
        Application $app,
        FilesystemInterface $filesystem,
        ConfigInterface $config
    )
    {
        parent::__construct($app, $filesystem, $config);
        $this->withClassName(sprintf('Version%s', date('YmdHis')));
    }




    /**
     * @inheritDoc
    */
    public function getBaseDir(): string
    {
        return $this->config['database.orm.mapper.migrations.dir'];
    }




    /**
     * @inheritDoc
    */
    public function getNamespace(): string
    {
        return $this->config['database.orm.mapper.migrations.prefix'];
    }




    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
         return __DIR__.'/stub/migration.stub';
    }
}
