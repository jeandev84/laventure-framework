<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem;

use Laventure\Component\Filesystem\Directory\Directory;
use Laventure\Component\Filesystem\Directory\Factory\DirectoryFactory;
use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Component\Filesystem\File\Collection\FileCollectionInterface;
use Laventure\Component\Filesystem\File\Contract\FileInterface;
use Laventure\Component\Filesystem\File\Factory\FileCollectionFactory;
use Laventure\Component\Filesystem\File\Factory\FileFactory;
use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\Locator\FileLocator;
use Laventure\Component\Filesystem\File\Locator\FileLocatorInterface;
use Laventure\Component\Filesystem\Stream\DTO\StreamParams;
use Laventure\Component\Filesystem\Stream\Factory\StreamFactory;
use Laventure\Component\Filesystem\Stream\Stream;

/**
 * Common
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common
*/
class Filesystem implements FilesystemInterface
{
    /**
     * @var FileLocator
    */
    protected FileLocator $fileLocator;


    /**
     * @var FileFactory
    */
    protected FileFactory $fileFactory;


    /**
     * @var DirectoryFactory
    */
    protected DirectoryFactory $directoryFactory;


    /**
     * @var StreamFactory
    */
    protected StreamFactory $streamFactory;


    /**
     * @var FileCollectionFactory
    */
    protected FileCollectionFactory $fileCollectionFactory;


    /**
     * @param string $basePath
    */
    public function __construct(string $basePath)
    {
        $this->fileLocator           = new FileLocator($basePath);
        $this->fileFactory           = new FileFactory();
        $this->directoryFactory      = new DirectoryFactory();
        $this->streamFactory         = new StreamFactory();
        $this->fileCollectionFactory = new FileCollectionFactory();
    }



    /**
     * @inheritDoc
    */
    public function setRoot(string $path): static
    {
        $this->fileLocator->setRoot($path);

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function getRoot(): string
    {
        return $this->fileLocator->getRoot();
    }







    /**
     * @inheritDoc
    */
    public function locate(string $path): string
    {
        return $this->fileLocator->locate($path);
    }





    /**
     * @inheritdoc
    */
    public function resources(string $pattern): array
    {
        return $this->fileLocator->locateResources($pattern);
    }




    /**
     * @inheritDoc
    */
    public function file(string $filename): FileInterface
    {
        return $this->fileFactory->create(
            $this->locate($filename)
        );
    }





    /**
     * @inheritdoc
    */
    public function dump(string $filename, string $content): bool
    {
        return $this->file($filename)->dump($content);
    }






    /**
     * @inheritDoc
     */
    public function dir(string $directory): Directory
    {
        return $this->directoryFactory->create(
            $this->locate($directory)
        );
    }





    /**
     * @inheritDoc
    */
    public function stream(StreamParams $dto): Stream
    {
        return $this->streamFactory->create(
            $dto->filename,
            $dto->mode,
            $dto->useIncludePath,
            $dto->context
        );
    }




    /**
     * @inheritDoc
    */
    public function collection(string $pattern): FileCollectionInterface
    {
        $files = $this->fileFactory->createFromArray(
            $this->resources($pattern)
        );

        return $this->fileCollectionFactory->create($files);
    }





    /**
     * @inheritDoc
    */
    public function collectionFilesFromDirectory(
        string $directory,
        string $extension = 'php'
    ): FileCollectionInterface {
        $files = $this->dir($directory)->getFiles($extension);

        $files = $this->fileFactory->createFromArray($files);

        return $this->fileCollectionFactory->create($files);
    }





    /**
     * @inheritDoc
    */
    public function getFileLocator(): FileLocatorInterface
    {
        return $this->fileLocator;
    }
}
