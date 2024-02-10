<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem;

use Laventure\Component\Filesystem\Directory\Directory;
use Laventure\Component\Filesystem\Directory\Factory\DirectoryFactory;
use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Component\Filesystem\File\Factory\FileCollectionFactory;
use Laventure\Component\Filesystem\File\Factory\FileFactory;
use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\Locator\FileLocator;
use Laventure\Component\Filesystem\Stream\DTO\StreamParams;
use Laventure\Component\Filesystem\Stream\Factory\StreamFactory;
use Laventure\Component\Filesystem\Stream\Stream;

/**
 * Filesystem
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem
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
    public function setBasePath(string $path): static
    {
        $this->fileLocator->setBasePath($path);

        return $this;
    }





    /**
     * @return string
    */
    public function getBasePath(): string
    {
        return $this->fileLocator->getBasePath();
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
    public function file(string $filename): File
    {
        return $this->fileFactory->create(
            $this->locate($filename)
        );
    }





    /**
     * @param string $filename
     * @param string $content
     * @return mixed
    */
    public function dump(string $filename, string $content): mixed
    {
        $file = $this->file($filename);
        $file->make();
        $file->write($content);
        return $this->locate($filename);
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
    public function collection(string $pattern): FileCollection
    {
        $files = $this->fileFactory->createFromArray(
            $this->resources($pattern)
        );

        return $this->fileCollectionFactory->create($files);
    }


    /**
     * @param string $directory
     * @param string $extension
     * @return FileCollection
    */
    public function directoryFileCollection(string $directory, string $extension = 'php'): FileCollection
    {
        $files = $this->dir($directory)->getFiles($extension);

        $files = $this->fileFactory->createFromArray($files);

        return $this->fileCollectionFactory->create($files);
    }





    /**
     * @return FileLocator
    */
    public function getFileLocator(): FileLocator
    {
        return $this->fileLocator;
    }





    /**
     * @return FileFactory
    */
    public function getFileFactory(): FileFactory
    {
        return $this->fileFactory;
    }





    /**
     * @return DirectoryFactory
    */
    public function getDirectoryFactory(): DirectoryFactory
    {
        return $this->directoryFactory;
    }




    /**
     * @return FileCollectionFactory
    */
    public function getFileCollectionFactory(): FileCollectionFactory
    {
        return $this->fileCollectionFactory;
    }




    /**
     * @return StreamFactory
    */
    public function getStreamFactory(): StreamFactory
    {
        return $this->streamFactory;
    }
}
