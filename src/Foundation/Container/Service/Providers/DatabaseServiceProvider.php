<?php
declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\Manager;
use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Manager\DatabaseManagerInterface;
use Laventure\Component\Database\Manager\Factory\DatabaseManagerFactory;
use Laventure\Component\Database\Manager\Factory\DatabaseManagerFactoryInterface;
use Laventure\Component\Database\Migrator\MigratorInterface;
use Laventure\Component\Database\Schema\SchemaInterface;
use Laventure\Foundation\Database\Configuration\ManagerConfiguration;
use Laventure\Foundation\Database\Configuration\ManagerConfigurationFactory;

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
        Manager::class => ['db.manager']
    ];




    /**
     * @inheritDoc
    */
    public function boot(): void
    {
        $this->app->singleton(ManagerConfiguration::class, function () {

             $config         = $this->app['config'];
             $connection     = $config->get('database.connection');
             $extension      = $config->get('database.extension');
             $credentialKey  = "database.connections.$extension.$connection";
             $credentials    = $config->get($credentialKey);

             return new ManagerConfiguration([
                 'connection'    => $connection,
                 'extension'     => $extension,
                 'credentials'   => $credentials
             ]);
        });
    }




    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singletons([
            Manager::class => function (ManagerConfiguration $config) {
                $database      = new Manager();
                $database->open($config->getConnection(), new Configuration($config->getCredentials()));
                return $database;
            },
            ConnectionInterface::class => function (Manager $manager) {
                return $manager->connection();
            },
            SchemaInterface::class => function (Manager $manager) {
               return $manager->schema();
            },
            MigratorInterface::class => function (Manager $manager) {
               return $manager->migration();
            }
        ]);
    }
}
