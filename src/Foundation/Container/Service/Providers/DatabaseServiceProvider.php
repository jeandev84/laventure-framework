<?php

declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Config\Config;
use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Manager;
use Laventure\Component\Database\Manager\Factory\DatabaseManagerFactory;
use Laventure\Component\Database\ORM\Persistence\Manager\Registry\ManagerRegistry;
use Laventure\Foundation\Database\Configuration\ManagerConfiguration;

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
        $this->app->singleton(ManagerConfiguration::class, function (Config $config) {

            $connection     = $config['database.connection'];
            $extension      = $config['database.extension'];
            $credentialKey  = "database.connections.$extension.$connection";
            $credentials    = $config[$credentialKey];

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
                $database->open($config->getConnection(), $config->getCredentials());
                return $database;
            },
            ManagerRegistry::class => function () {
                return new ManagerRegistry();
            }
        ]);
    }
}
