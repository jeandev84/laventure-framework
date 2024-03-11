<?php

declare(strict_types=1);

namespace Laventure\Foundation\Providers;

use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Http\Message\Response\Factory\ResponseFactory;
use Laventure\Foundation\Facade\Route\Route;
use Psr\Http\Message\ResponseFactoryInterface;
use ReflectionException;

/**
 * ApplicationServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Providers
 */
class ApplicationServiceProvider extends ServiceProvider implements BootableServiceProvider
{
    /**
     * @var array
     */
    protected array $provides = [
        ResponseFactoryInterface::class => [
            ResponseFactory::class
        ]
    ];




    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $this->loadHelpers();
        $this->loadFacades();
    }



    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->singletons([
            ResponseFactoryInterface::class => ResponseFactory::class
        ]);
    }




    /**
     * @return void
    */
    private function loadHelpers(): void
    {
        require_once realpath(__DIR__.'/utils/helpers.php');
    }




    /**
     * @return void
     * @throws ContainerException
     * @throws ReflectionException
    */
    private function loadFacades(): void
    {
        $this->app->addFacades([
            Route::class,
        ]);
    }
}
