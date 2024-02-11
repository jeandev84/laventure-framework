<?php
declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Component\Templating\Renderer\Renderer;
use Laventure\Component\Templating\Renderer\RendererInterface;
use Laventure\Component\Templating\Template\Engine\TemplateEngine;
use Laventure\Foundation\Templating\Cache\TemplateCache;
use Laventure\Foundation\Templating\Loader\TemplateLoader;

/**
 * ViewServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Providers
*/
class ViewServiceProvider extends ServiceProvider
{
    /**
     * @var array
    */
    protected array $provides = [
        RendererInterface::class => [
            Renderer::class, 'view'
        ]
    ];



    /**
     * @inheritDoc
    */
    public function register(): void
    {
        // TODO refactoring more better
        $this->app->singleton(RendererInterface::class, function () {
            $filesystem = new Filesystem($this->app['basePath'] . '/resources/views');
            $loader     = new TemplateLoader($filesystem);
            $cacheFs    = $this->app[Filesystem::class];
            $cacheFs->setBasePath($this->app['basePath'] . '/storage/cache/views');
            $cache      = new TemplateCache($this->app[Filesystem::class]);
            $engine     = new TemplateEngine($loader, $cache);

            return new Renderer($engine);
        });
    }
}
