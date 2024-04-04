<?php
declare(strict_types=1);

namespace Laventure\Foundation\Loader\Repository;


use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Repository\Contract\EntityRepositoryInterface;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Foundation\Application;
use Laventure\Foundation\Loader\FilesDirectory\FilesDirectoryLoader;
use Psr\Container\ContainerInterface;

/**
 * EntityRepositoryLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Repository
*/
class EntityRepositoryLoader extends FilesDirectoryLoader implements EntityRepositoryLoaderInterface
{

    const PREFIX = 'database.orm.persistence.';

    protected array $repositories = [];


    /**
     * @param Application $app
     * @param Filesystem $filesystem
     * @param ConfigInterface $config
    */
    public function __construct(
        protected Application $app,
        Filesystem $filesystem,
        ConfigInterface $config
    )
    {
        parent::__construct($filesystem, $config);
    }




    /**
     * @inheritDoc
    */
    public function getPrefix(): string
    {
        return $this->config[self::PREFIX . 'repository.prefix'];
    }




    /**
     * @inheritDoc
    */
    public function getDirectory(): string
    {
        return $this->config[self::PREFIX. 'repository.dir'];
    }




    /**
     * @inheritDoc
    */
    public function loadRepositories(EntityManagerInterface $em): array
    {
        foreach ($this->load() as $classname) {
            $this->loadRepository(
                $this->app->make($classname, compact('em'))
            );
        }

        return $this->repositories;
    }





    /**
     * @param EntityRepositoryInterface $repository
     * @return EntityRepositoryInterface
    */
    public function loadRepository(EntityRepositoryInterface $repository): EntityRepositoryInterface
    {
        return $this->repositories[] = $repository;
    }
}