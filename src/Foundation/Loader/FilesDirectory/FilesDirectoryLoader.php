<?php
declare(strict_types=1);

namespace Laventure\Foundation\Loader\FilesDirectory;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Contract\Loader\LoaderInterface;

/**
 * FilesDirectoryLoader
 *
 * Load all files of directory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\FilesDirectory
*/
abstract class FilesDirectoryLoader implements LoaderInterface
{
    /**
     * @var Filesystem
    */
    protected Filesystem $filesystem;





    /**
     * @var ConfigInterface
    */
    protected ConfigInterface $config;






    /**
     * @param Filesystem $filesystem
     * @param ConfigInterface $config
    */
    public function __construct(Filesystem $filesystem, ConfigInterface $config) {
        $this->filesystem = $filesystem;
        $this->config     = $config;
    }





    /**
     * Collection file mapped
     *
     * @return FileCollection
    */
    public function getFileCollection(): FileCollection
    {
        return $this->filesystem->directoryFiles(
            $this->getDirectory()
        );
    }




    /**
     * @return array
    */
    public function load(): array
    {
        $controllers = [];
        $collection = $this->getFileCollection();
        $paths = array_keys($collection->getPaths());

        foreach ($paths as $path) {
            $classname     = $this->resolvePath($path);
            if (class_exists($classname)) {
                $controllers[] =  $classname;
            }
        }

        return $controllers;
    }








    /**
     * @param string $path
     * @return string
    */
    private function resolvePath(string $path): string
    {
        $namespace = $this->getPrefix();
        $search    = [$this->getDirectory(), '/'];
        $replaces  = [$namespace, "\\"];
        $basePath  = $this->filesystem->getRoot();
        $path      = str_replace($basePath, '', $path);
        $path      = ltrim($path, '/');
        $info      = pathinfo($path);
        $dirname   = str_replace($search, $replaces, $info['dirname']);
        $filename = $info['filename'];
        return "$dirname\\$filename";
    }





    /**
     * Namespace
     *
     * @return string
     */
    abstract public function getPrefix(): string;






    /**
     * @return string
    */
    abstract public function getDirectory(): string;
}