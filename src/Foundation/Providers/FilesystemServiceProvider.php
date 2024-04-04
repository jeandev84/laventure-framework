<?php

declare(strict_types=1);

namespace Laventure\Foundation\Providers;

use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Filesystem\File\Locator\FileLocator;
use Laventure\Component\Filesystem\File\Locator\FileLocatorInterface;
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
       ],
       FileLocatorInterface::class => [
           FileLocator::class
       ]
    ];


    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singletons([
           FilesystemInterface::class => Filesystem::class,
           FileLocatorInterface::class => function (Filesystem $filesystem) {
               return $filesystem->getFileLocator();
           }
        ]);
    }
}
