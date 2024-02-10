<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Controller\Loader;

use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Component\Filesystem\File\Loader\FileLoader;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Contract\Loader\LoaderInterface;

/**
 * ControllerLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Controller\Loader
*/
class ControllerLoader implements LoaderInterface
{
    /**
     * @var Filesystem
    */
    protected Filesystem $filesystem;


    /**
     * @var string
    */
    protected string $namespace;


    /**
     * @var string
    */
    protected string $controllerPath;


    /**
     * @param Filesystem $filesystem
     * @param string $namespace
     * @param string $controllerPath
    */
    public function __construct(
        Filesystem $filesystem,
        string     $namespace,
        string     $controllerPath
    ) {
        $this->filesystem     = $filesystem;
        $this->namespace      = $namespace;
        $this->controllerPath = $controllerPath;
    }


    /**
     * @return FileCollection
    */
    public function getCollection(): FileCollection
    {
        return $this->filesystem->directoryFileCollection($this->controllerPath);
    }



    public function load(): array
    {
        $controllers = [];
        $collection = $this->getCollection();
        $paths = array_keys($collection->getPaths());

        foreach ($paths as $path) {
            $classname     = $this->replacePath($path);
            if (class_exists($classname)) {
                $controllers[] =  $classname;
            }
        }

        return $controllers;
    }



    /**
     * @return string
    */
    public function getControllerPath(): string
    {
        return $this->controllerPath;
    }




    /**
     * @return string
    */
    public function getNamespace(): string
    {
        return $this->namespace;
    }


    /**
     * @param string $path
     * @return string
    */
    private function replacePath(string $path): string
    {
        $search   = [$this->controllerPath, '/'];
        $replaces = [$this->namespace, "\\"];
        $basePath = $this->filesystem->getBasePath();
        $path     = str_replace($basePath, '', $path);
        $path     = ltrim($path, '/');
        $info     = pathinfo($path);
        $dirname  = str_replace($search, $replaces, $info['dirname']);
        $filename = $info['filename'];
        return "$dirname\\$filename";
    }
}
