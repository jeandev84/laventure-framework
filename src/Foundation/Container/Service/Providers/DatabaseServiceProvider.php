<?php
declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Config\Config;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Database\Manager\Manager;
use Laventure\Component\Database\ORM\Persistence\Manager\Registry\ManagerRegistry;

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
        Manager::class => ['db.manager']
    ];





    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singletons([
            Manager::class => function (Config $config) {

                $connection     = $config['database.connection'];
                $extension      = $config['database.extension'];
                $credentialKey  = "database.connections.$extension.$connection";
                $credentials    = $config[$credentialKey];

                $database = new Manager();
                $database->addConnections([
                    'connection'    => $connection,
                    'extension'     => $extension,
                    'credentials'   => $credentials,
                    'connections'   => $config['database.connections']
                ]);

                $database->bootConnection();

                return $database;
            },
            ManagerRegistry::class => function () {
                return new ManagerRegistry();
            }
        ]);
    }
}
