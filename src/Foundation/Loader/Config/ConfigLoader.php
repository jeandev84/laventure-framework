<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\Config;

use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Component\Filesystem\File\Loader\ArrayLoader;
use Laventure\Component\Filesystem\File\Loader\FileLoader;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Contract\Loader\LoaderInterface;

/**
 * ConfigLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Common
*/
class ConfigLoader extends FileLoader
{
    /**
     * @var Filesystem
    */
    protected Filesystem $filesystem;


    /**
     * @param Filesystem $filesystem
    */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        parent::__construct('/config/main/*.php');
    }




    /**
     * @return FileCollection
    */
    public function getCollection(): FileCollection
    {
        return $this->filesystem->collection($this->file);
    }




    /**
     * @return LoaderInterface
    */
    public function make(): LoaderInterface
    {
        return new ArrayLoader($this->getCollection());
    }




    /**
     * @inheritDoc
    */
    public function load(): array
    {
        return $this->make()->load();
    }
}
