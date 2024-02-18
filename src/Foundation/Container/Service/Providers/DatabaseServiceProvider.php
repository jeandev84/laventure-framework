<?php
declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsnBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Manager\DatabaseManagerFactory;
use Laventure\Component\Database\Manager\DatabaseManagerFactoryInterface;
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
class DatabaseServiceProvider extends ServiceProvider implements BootableServiceProvider
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
    public function boot(): void
    {
        $config        = $this->app['config'];
        $connection    = $config->get('database.connection');
        $extension     = $config->get('database.extension');
        $credentialKey = "database.connections.$extension.$connection";
        $credentials   = $config->get($credentialKey);

        $this->app->bindings([
            'db.connection'    => $connection,
            'db.credentialKey' => "database.connections.$extension.$connection",
            'db.extension'     => $extension,
            'db.credentials'   => $credentials
        ]);


        $this->app->singleton(PdoConnectionFactoryInterface::class,
            function () {
             return new PdoConnectionFactory();
        });

        $this->app->singleton(DatabaseManagerFactoryInterface::class,
            function (PdoConnectionFactoryInterface $factory) {
             return new DatabaseManagerFactory($factory);
        });
    }




    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singleton(DatabaseManagerInterface::class,
            function (DatabaseManagerFactoryInterface $factory) {
                $database = $factory->createDatabaseManager();
                $database->open(
                    $this->app['db.connection'],
                    $this->resolveConfiguration(
                        $this->app['db.connection'],
                        $this->app['db.credentials']
                    )
                );
                return $database;
        });
    }





    /**
     * @param string $connection
     * @param array $credentials
     * @return ConfigurationInterface
    */
    public function resolveConfiguration(string $connection, array $credentials): ConfigurationInterface
    {
        $config = new Configuration($credentials);
        switch ($connection):
            case 'pdo': $config['dsn'] = $this->resolvePdoDsn($config); break;
        endswitch;

        return $config;
    }







    /**
     * @param ConfigurationInterface $config
     * @return string
    */
    public function resolvePdoDsn(ConfigurationInterface $config): string
    {
        $driver = $config->get('driver');

        if ($config->has('dsn')) {
            $dsn = $config['dsn'];
            if (is_array($dsn)) {
                return $this->buildDsn($driver, $dsn);
            }
            return $dsn;
        }

        return $this->buildDsn($driver, $this->getDefaultParams($config));
    }







    /**
     * @param string $driver
     * @param array $params
     * @return string
    */
    private function buildDsn(string $driver, array $params): string
    {
        return strval(PdoDsnBuilder::create($driver, $params));
    }







    /**
     * @param ConfigurationInterface $config
     * @return array
    */
    private function getDefaultParams(ConfigurationInterface $config): array
    {
        return [
            'host'     => $config->host(),
            'port'     => $config->port(),
            'dbname'   => $config->database(),
            'charset'  => $config->get('charset', 'utf8'),
            'username' => $config->username(),
            'password' => $config->password()
        ];
    }
}
