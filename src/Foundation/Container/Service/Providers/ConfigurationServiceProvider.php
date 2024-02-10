<?php

declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Config\Config;
use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Dotenv\Contract\DotenvInterface;
use Laventure\Dotenv\Dotenv;
use Laventure\Foundation\Config\Loader\ConfigLoader;

/**
 * ConfigurationServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Container\Providers
 */
class ConfigurationServiceProvider extends ServiceProvider implements BootableServiceProvider
{
    private string $pattern = '/config/params/*.php';


    /**
     * @var array
     */
    protected array $provides = [
        ConfigInterface::class => [
            Config::class,
            'config'
        ]
    ];


    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $this->dotEnv()->load();
    }



    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->bind('app.env', $_ENV);
        $this->app->singleton(ConfigLoader::class, function () {
            return new ConfigLoader($this->app[Filesystem::class], $this->pattern);
        });
        $this->app->singleton(ConfigInterface::class, function () {
            $loader = $this->app[ConfigLoader::class];
            return new Config($loader->load());
        });
    }




    private function dotEnv(): DotenvInterface
    {
        return $this->app->make(Dotenv::class);
    }
}
