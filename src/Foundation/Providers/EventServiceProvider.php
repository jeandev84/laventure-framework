<?php

declare(strict_types=1);

namespace Laventure\Foundation\Providers;

use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Event\Dispatcher\EventDispatcher;
use Laventure\Component\Event\Listener\ListenerProvider;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * EventServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Providers
*/
class EventServiceProvider extends ServiceProvider
{
    protected array $provides = [
        ListenerProvider::class => [
            ListenerProviderInterface::class
        ],
        EventDispatcher::class => [
            EventDispatcherInterface::class
        ]
    ];


    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singletons([
            ListenerProviderInterface::class => ListenerProvider::class,
            EventDispatcherInterface::class => EventDispatcher::class
        ]);
    }
}
