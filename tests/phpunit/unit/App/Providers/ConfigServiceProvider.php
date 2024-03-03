<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Providers;

use Laventure\Component\Config\Config;
use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;

/**
 * ConfigServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Providers
 */
class ConfigServiceProvider extends ServiceProvider implements BootableServiceProvider
{
    protected array $provides = [
        Config::class => [
            'app.demo',
            ConfigInterface::class
        ]
    ];



    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $this->app->bind('demo.booted', 'BootedConfig');
    }


    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singleton(Config::class, function () {
            return $this->app->make(Config::class, ['demo' => $_ENV]);
        });
    }
}
