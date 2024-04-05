<?php

declare(strict_types=1);

namespace Laventure\Foundation\Providers;

use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Templating\Renderer\Renderer;
use Laventure\Component\Templating\Renderer\RendererInterface;
use Laventure\Component\Templating\Template\Engine\Config\TemplateEngineConfig;
use Laventure\Component\Templating\Template\Engine\Config\TemplateEngineConfigInterface;
use Laventure\Component\Templating\Template\Engine\TemplateEngine;
use Laventure\Foundation\Templating\Template\Cache\CompiledTemplateCache;
use Laventure\Foundation\Templating\Template\Factory\TemplateFactory;
use Laventure\Foundation\Templating\Template\Loader\TemplateLoader;
use Laventure\Foundation\Templating\Template\Reader\TemplateReader;

/**
 * ViewServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Providers
*/
class ViewServiceProvider extends ServiceProvider implements BootableServiceProvider
{
    /**
     * @var array
    */
    protected array $provides = [
        TemplateEngineConfigInterface::class => [
            TemplateEngineConfig::class
        ],
        RendererInterface::class => [
            Renderer::class,
            'view'
        ]
    ];



    /**
     * @inheritDoc
    */
    public function boot(): void
    {
        $this->app->singleton(TemplateEngineConfigInterface::class, function () {

            $config    = new TemplateEngineConfig();
            $viewPath  = $this->app['basePath'] . '/resources/views';
            $cachePath = $this->app['basePath'] . '/storage/caching/views';

            $config->withTemplateFactory(new TemplateFactory($viewPath))
                   ->withReader(new TemplateReader())
                   ->withLoader(new TemplateLoader())
                   ->withCache(new CompiledTemplateCache($cachePath));

            return $config;
        });

    }



    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singleton(RendererInterface::class, function (TemplateEngineConfig $config) {
            return new Renderer(new TemplateEngine($config));
        });
    }
}
