<?php
declare(strict_types=1);

namespace Laventure\Foundation\Providers;

use Laventure\Component\Config\Config;
use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Manager\Contract\ManagerInterface;
use Laventure\Component\Database\Manager\Manager;
use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Contract\ObjectManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Definition;
use Laventure\Component\Database\ORM\Persistence\Manager\EntityManager;
use Laventure\Component\Database\ORM\Persistence\Manager\Factory\EntityManagerFactory;
use Laventure\Component\Database\ORM\Persistence\Manager\Registry\ManagerRegistry;
use Laventure\Component\Database\ORM\Persistence\Manager\Registry\ManagerRegistryInterface;
use Laventure\Component\Database\Schema\Migrator\MigratorInterface;

/**
 * DatabaseServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Providers
*/
class DatabaseServiceProvider extends ServiceProvider implements BootableServiceProvider
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
        ]
    ];




    /**
     * @inheritDoc
    */
    public function boot(): void
    {

    }




    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singletons([
            ManagerInterface::class => function (Config $config) {
                $database = new Manager();
                $database->addCredentials($config['database']);
                $database->bootManager();
                return $database;
            },
            ConnectionInterface::class => function (ManagerInterface $manager) {
                return $manager->connection();
            },
            EntityManagerInterface::class => function (ConnectionInterface $connection) {
                $entityManagerFactory = new EntityManagerFactory();
                return $entityManagerFactory->createFromConnection($connection);
            },
            ManagerRegistryInterface::class => function (EntityManagerInterface $em) {
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
