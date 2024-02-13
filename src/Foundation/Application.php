<?php

declare(strict_types=1);

namespace Laventure\Foundation;

use Laventure\Component\Container\Container;
use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Contract\Application\ApplicationInterface;
use Laventure\Foundation\Container\Service\Providers\ApplicationServiceProvider;
use Laventure\Foundation\Container\Service\Providers\ConfigurationServiceProvider;
use Laventure\Foundation\Container\Service\Providers\DatabaseServiceProvider;
use Laventure\Foundation\Container\Service\Providers\EventServiceProvider;
use Laventure\Foundation\Container\Service\Providers\FilesystemServiceProvider;
use Laventure\Foundation\Container\Service\Providers\RouterServiceProvider;
use Laventure\Foundation\Container\Service\Providers\ViewServiceProvider;
use Laventure\Traits\Application\ApplicationTrait;
use Psr\Container\ContainerInterface;
use ReflectionException;

/**
 * Application
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation
*/
final class Application extends Container implements ApplicationInterface
{
    use ApplicationTrait;




    /**
     * @param string $basePath
     * @throws ContainerException
     * @throws ReflectionException
    */
    public function __construct(string $basePath)
    {
        $this->setPath($basePath);
        $this->registerBaseBindings();
        $this->registerBaseProviders();
    }






    /**
     * @param string $basePath
     * @return $this
     */
    private function setPath(string $basePath): static
    {
        $this->bindings(compact('basePath'));
        $this->bindings([
            'app.path' => $basePath
        ]);

        return $this;
    }




    /**
     * @return void
    */
    private function registerBaseBindings(): void
    {
        static::setInstance($this);
        $this->instances([
            self::class => $this,
            Container::class => $this,
            ContainerInterface::class => $this
        ]);
    }




    /**
     * @return void
     * @throws ContainerException
     * @throws ReflectionException
    */
    private function registerBaseProviders(): void
    {
        $this->addProviders([
            ApplicationServiceProvider::class,
            FilesystemServiceProvider::class,
            ConfigurationServiceProvider::class,
            DatabaseServiceProvider::class,
            RouterServiceProvider::class,
            EventServiceProvider::class,
            ViewServiceProvider::class
        ]);
    }
}
