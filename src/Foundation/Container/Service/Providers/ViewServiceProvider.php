<?php
declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Filesystem\File\Locator\FileLocator;
use Laventure\Component\Templating\Renderer\Renderer;
use Laventure\Component\Templating\Renderer\RendererInterface;
use Laventure\Component\Templating\Template\Engine\Config\TemplateEngineConfig;
use Laventure\Component\Templating\Template\Engine\Config\TemplateEngineConfigInterface;
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
            Renderer::class, 'view'
        ]
    ];



    /**
     * @inheritDoc
    */
    public function boot(): void
    {
        $this->app->singleton(TemplateEngineConfigInterface::class, function () {
             $config  = new TemplateEngineConfig();
             $locator = new FileLocator($this->app['basePath'] . '/resources/views');
             $config->withTemplateFactory(new TemplateFactory($locator))
                    ->withReader(new TemplateReader())
                    ->withLoader(new TemplateLoader());

             return $config;
        });

    }



    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singleton(RendererInterface::class, function () {

            /*
            $filesystem = new Filesystem($this->app['basePath'] . '/resources/views');
            $loader     = new TemplateLoader($filesystem);
            $cacheFs    = $this->app[Filesystem::class];
            $cacheFs->setBasePath($this->app['basePath'] . '/storage/cache/views');
            $cache      = new CompiledTemplateCache($this->app[Filesystem::class]);
            $engine     = new TemplateEngine($loader, $cache);

            return new Renderer($engine);
            */

            return false;
        });
    }
}
