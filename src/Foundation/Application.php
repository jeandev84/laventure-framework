<?php

declare(strict_types=1);

namespace Laventure\Foundation;

use Laventure\Component\Container\Container;
use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Contract\Application\ApplicationInterface;
use Laventure\Foundation\Providers\ApplicationServiceProvider;
use Laventure\Foundation\Providers\ConfigurationServiceProvider;
use Laventure\Foundation\Providers\DatabaseServiceProvider;
use Laventure\Foundation\Providers\EventServiceProvider;
use Laventure\Foundation\Providers\FilesystemServiceProvider;
use Laventure\Foundation\Providers\RouterServiceProvider;
use Laventure\Foundation\Providers\ViewServiceProvider;
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
     * @var string
    */
    protected string $basePath;



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
    public function setPath(string $basePath): static
    {
        $basePath = rtrim(realpath($basePath), '\\/');

        $this->binds(compact('basePath'));

        $this->basePath = $basePath;

        return $this;
    }




    /**
     * Load path
     *
     * @param string $path
     * @return string
    */
    public function path(string $path = ''): string
    {
        return $this->basePath . ($path ? DIRECTORY_SEPARATOR . trim($path, '\\/') : $path);
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
