<?php

declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Component\Filesystem\FilesystemInterface;

/**
 * FilesystemServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Providers
*/
class FilesystemServiceProvider extends ServiceProvider
{
    /**
     * @var array
    */
    protected array $provides = [
       Filesystem::class => [
           FilesystemInterface::class
       ]
    ];


    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singleton(Filesystem::class, Filesystem::class);
    }
}
