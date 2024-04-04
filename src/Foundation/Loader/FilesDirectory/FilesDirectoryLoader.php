<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\FilesDirectory;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Component\Filesystem\File\Collection\FileCollectionInterface;
use Laventure\Component\Filesystem\File\Convertor\FileToClassConvertor;
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
abstract class FilesDirectoryLoader implements FilesDirectoryLoaderInterface
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
    public function __construct(
        Filesystem $filesystem,
        ConfigInterface $config
    ) {
        $this->filesystem = $filesystem;
        $this->config     = $config;
    }





    /**
     * @inheritDoc
    */
    public function getCollection(): FileCollectionInterface
    {
        return $this->filesystem->collectionFilesFromDirectory(
            $this->getDirectory()
        );
    }





    /**
     * @return ConfigInterface
    */
    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }





    /**
     * @return array
    */
    public function load(): array
    {
        $convertor = new FileToClassConvertor(
            $this->filesystem->getRoot(),
            $this->getDirectory(),
            $this->getPrefix(),
            $this->getCollection()->getPaths()
        );

        return $convertor->convert();
    }
}
