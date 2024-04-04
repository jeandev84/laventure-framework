<?php

declare(strict_types=1);

namespace Laventure\Foundation\Providers;

use Laventure\Component\Config\Config;
use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Manager\Contract\ObjectManagerInterface;
use Laventure\Component\Database\ORM\Manager\EntityManager;
use Laventure\Component\Database\ORM\Manager\Factory\EntityManagerFactory;
use Laventure\Component\Database\ORM\Manager\Fixtures\Factory\FixtureManagerFactory;
use Laventure\Component\Database\ORM\Manager\Fixtures\FixtureInterface;
use Laventure\Component\Database\ORM\Manager\Fixtures\FixtureManager;
use Laventure\Component\Database\ORM\Manager\Fixtures\FixtureManagerInterface;
use Laventure\Component\Database\ORM\Manager\Registry\ManagerRegistry;
use Laventure\Component\Database\ORM\Manager\Registry\ManagerRegistryInterface;
use Laventure\Component\Database\Schema\Migrator\Migrator;
use Laventure\Component\Database\Schema\Migrator\MigratorInterface;
use Laventure\Component\Database\Schema\Schema;
use Laventure\Component\Database\Schema\SchemaInterface;
use Laventure\Foundation\Database\Manager\Config\ManagerConfigurationInterface;
use Laventure\Foundation\Database\Manager\Factory\ManagerFactory;
use Laventure\Foundation\Database\Manager\Manager;
use Laventure\Foundation\Database\Manager\ManagerInterface;
use Laventure\Foundation\Loader\Fixture\FixtureLoader;
use Laventure\Foundation\Loader\Migration\Factory\MigrationLoaderFactory;
use Laventure\Foundation\Loader\Migration\MigrationLoaderInterface;
use Laventure\Foundation\Loader\Repository\EntityRepositoryLoader;

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
            Manager::class, 'db.manager'
        ],
        EntityManagerInterface::class => [
            EntityManager::class,
            ObjectManagerInterface::class
        ],
        ManagerRegistryInterface::class => [
            ManagerRegistry::class, 'db.manager.registry'
        ],
        SchemaInterface::class => [
           Schema::class, 'schema'
        ],
        MigratorInterface::class => [
            Migrator::class, 'migrator'
        ],
        FixtureManagerInterface::class => [
            FixtureManager::class, 'fixtures'
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
            ManagerConfigurationInterface::class => function (ManagerInterface $manager) {
                return $manager->config();
            },
            ConnectionInterface::class => function (ManagerInterface $manager) {
                return $manager->connection();
            },
            EntityManagerInterface::class => function (
                EntityManagerFactory $entityManagerFactory,
                ConnectionInterface $connection,
                EntityRepositoryLoader $repositoryLoader
            ) {
                 $em = $entityManagerFactory->createFromConnection($connection);
                 $repositories = $repositoryLoader->loadRepositories($em);
                 $em->addRepositories($repositories);
                 return $em;
            },
            ManagerRegistryInterface::class => function (
                EntityManagerInterface $em
            ) {
                $registry = new ManagerRegistry();
                $registry->setManager($em);
                return $registry;
            },
            SchemaInterface::class => function (
                ManagerInterface $manager
            ) {
               return $manager->schema();
            },
            MigrationLoaderInterface::class => function (
                MigrationLoaderFactory $migrationLoaderFactory,
                ConfigInterface $config
            ) {
                return $migrationLoaderFactory->createMigrationLoader(
                    $config->get('database.orm.current')
                );
            },
            MigratorInterface::class => function (
                ManagerInterface $manager,
                MigrationLoaderInterface $migrationLoader
            ) {
                $migrator = $manager->migration();
                $migrator->addMigrations($migrationLoader->loadMigrations());
                return $migrator;
            },
            FixtureManagerInterface::class => function (
                FixtureManagerFactory $fixtureManagerFactory,
                FixtureLoader $fixtureLoader
            ) {
                $fixtureManager = $fixtureManagerFactory->create();
                $fixtureManager->addFixtures($fixtureLoader->loadFixtures());
                return $fixtureManager;
            }
        ]);
    }
}