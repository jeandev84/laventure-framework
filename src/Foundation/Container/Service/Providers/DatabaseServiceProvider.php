<?php

declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsnBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Manager\DatabaseManagerFactory;
use Laventure\Component\Database\Manager\DatabaseManagerFactoryInterface;
use Laventure\Component\Database\Manager\DatabaseManagerInterface;
use Laventure\Foundation\Database\Configuration\DatabaseConfigurationManager;

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
        DatabaseManagerInterface::class => [
            DatabaseManager::class,
            'database.manager'
        ]
    ];




    /**
     * @inheritDoc
    */
    public function boot(): void
    {
        $this->app->singleton(DatabaseConfigurationManager::class, function () {

             $config         = $this->app['config'];
             $connection     = $config->get('database.connection');
             $extension      = $config->get('database.extension');
             $credentialKey  = "database.connections.$extension.$connection";
             $credentials    = $config->get($credentialKey);

             return new DatabaseConfigurationManager([
                 'connection'    => $connection,
                 'extension'     => $extension,
                 'credentials'   => $credentials
             ]);
        });

        $this->app->singleton(
         PdoConnectionFactoryInterface::class,
            function () {
                return new PdoConnectionFactory();
            }
        );

        $this->app->singleton(
         DatabaseManagerFactoryInterface::class,
            function (PdoConnectionFactoryInterface $factory) {
                return new DatabaseManagerFactory($factory);
            }
        );
    }




    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singleton(
         DatabaseManagerInterface::class,
            function (DatabaseManagerFactoryInterface $factory, DatabaseConfigurationManager $config) {
                $database = $factory->createDatabaseManager();
                $database->open($config->getConnection(), $config->getConfiguration());
                return $database;
            }
        );

        $this->app->singleton(ConnectionInterface::class, function (DatabaseManagerInterface $manager) {
            return $manager->connection();
        });
    }
}
