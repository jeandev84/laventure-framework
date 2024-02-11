<?php

declare(strict_types=1);

namespace Laventure\Foundation\Templating\Loader;

use Laventure\Component\Filesystem\File\Loader\FileLoader;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Component\Templating\Template\Loader\TemplateLoaderInterface;

/**
 * TemplateLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Templating\Loader
 */
class TemplateLoader implements TemplateLoaderInterface
{
    private Filesystem $filesystem;

    /**
     * @param Filesystem $filesystem
    */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }



    /**
     * @inheritDoc
    */
    public function locatePath(string $path): string
    {
        return $this->filesystem->locate($path);
    }



    /**
     * @inheritDoc
    */
    public function loadContent(string $path): string
    {
        return $this->filesystem->file($path)->read();
    }





    /**
     * @inheritDoc
    */
    public function setResourcePath(string $path): static
    {
        $this->filesystem->setBasePath($path);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getResourcePath(): string
    {
        return $this->filesystem
                    ->getFileLocator()
                    ->getBasePath();
    }
}
