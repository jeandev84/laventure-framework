<?php

declare(strict_types=1);

namespace Laventure\Foundation\Providers;

use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Http\Handlers\QueueRequestHandler;
use Laventure\Foundation\Http\Handlers\MiddlewareStackHandler;

/**
 * MiddlewareServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Providers
 */
class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * @var array
    */
    protected array $provides = [];



    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singletons([
            MiddlewareStackHandler::class => MiddlewareStackHandler::class,
            QueueRequestHandler::class    => QueueRequestHandler::class
        ]);
    }
}
