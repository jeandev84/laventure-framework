<?php

declare(strict_types=1);

namespace Laventure\Foundation\Providers;

use Laventure\Component\Config\Config;
use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Contract\ObjectManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\EntityManager;
use Laventure\Component\Database\ORM\Persistence\Manager\Factory\EntityManagerFactory;
use Laventure\Component\Database\ORM\Persistence\Manager\Registry\ManagerRegistry;
use Laventure\Component\Database\ORM\Persistence\Manager\Registry\ManagerRegistryInterface;
use Laventure\Component\Database\Schema\Migrator\Migrator;
use Laventure\Component\Database\Schema\Migrator\MigratorInterface;
use Laventure\Foundation\Database\Manager\Config\ManagerConfigurationInterface;
use Laventure\Foundation\Database\Manager\Factory\ManagerFactory;
use Laventure\Foundation\Database\Manager\Manager;
use Laventure\Foundation\Database\Manager\ManagerInterface;
use Laventure\Foundation\Loader\Migration\Factory\MigrationLoaderFactory;
use Laventure\Foundation\Loader\Migration\MigrationDirectoryLoader;
use Laventure\Foundation\Loader\Migration\MigrationLoaderInterface;

/**
 * DatabaseServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Providers
*/
class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * @var array|array[]
    */
    protected array $provides = [
        ManagerInterface::class => [
            Manager::class,
            'db.manager'
        ],
        EntityManagerInterface::class => [
            EntityManager::class,
            ObjectManagerInterface::class
        ],
        ManagerRegistryInterface::class => [
            ManagerRegistry::class,
            'db.manager.registry'
        ],
        MigratorInterface::class => [
            Migrator::class,
            'migrator'
        ]
    ];





    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singletons([
            ManagerInterface::class => function (
                ManagerFactory $managerFactory,
                Config $config
            ) {
                $manager = $managerFactory->createManager();
                $manager->addCredentials($config['database']);
                $manager->bootManager();
                return $manager;
            },
            MigrationLoaderInterface::class => function (
                MigrationLoaderFactory $migrationLoaderFactory,
                ConfigInterface $config
            ) {
                return $migrationLoaderFactory->createMigrationLoader(
                    $config->get('database.orm.current')
                );
            },
            ManagerConfigurationInterface::class => function (ManagerInterface $manager) {
                return $manager->getConfiguration();
            },
            ConnectionInterface::class => function (ManagerInterface $manager) {
                return $manager->connection();
            },
            EntityManagerInterface::class => function (
                EntityManagerFactory $entityManagerFactory,
                ConnectionInterface $connection
            ) {
                return $entityManagerFactory->createFromConnection($connection);
            },
            ManagerRegistryInterface::class => function (
                EntityManagerInterface $em
            ) {
                $registry = new ManagerRegistry();
                $registry->setManager($em);
                return $registry;
            },
            MigratorInterface::class => function (ManagerInterface $manager) {
                return $manager->migration();
            }
        ]);
    }
}
