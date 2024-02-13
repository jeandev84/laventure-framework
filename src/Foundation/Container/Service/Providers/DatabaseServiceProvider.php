<?php
declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Container\Service\Provider\ServiceProvider;

use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Manager\DatabaseManagerInterface;

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
        DatabaseManagerInterface::class => [DatabaseManager::class, 'db']
    ];



    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singleton(DatabaseManagerInterface::class, function () {
            $config        = $this->app['config'];
            $connection    = $config->get('database.connection');
            $extension     = $config->get('database.extension');
            $credentialKey = "database.connections.$extension.$connection";
            $credentials   = $config->get($credentialKey);
            $database      = new DatabaseManager();
            $database->open($connection, $credentials);
            return $database;
        });
    }
}
