<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem;

use Laventure\Component\Filesystem\Directory\Contract\DirectoryInterface;
use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Component\Filesystem\File\Collection\FileCollectionInterface;
use Laventure\Component\Filesystem\File\Contract\FileInterface;
use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\Locator\FileLocator;
use Laventure\Component\Filesystem\File\Locator\FileLocatorInterface;
use Laventure\Component\Filesystem\Stream\DTO\StreamParams;
use Laventure\Component\Filesystem\Stream\Stream;

/**
 * FilesystemInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common
 */
interface FilesystemInterface
{
    /**
     * set base path
     *
     * @param string $path
     *
     * @return mixed
    */
    public function setRoot(string $path): static;





    /**
     * Returns base root
     *
     * @return string
    */
    public function getRoot(): string;





    /**
     * locate path
     *
     * @param string $path
     * @return string
    */
    public function locate(string $path): string;






    /**
     * @param string $pattern
     *
     * @return array
    */
    public function resources(string $pattern): array;





    /**
     * @param string $filename
     * @return FileInterface
    */
    public function file(string $filename): FileInterface;







    /**
     * @param string $directory
     * @return DirectoryInterface
    */
    public function dir(string $directory): DirectoryInterface;






    /**
     * @param StreamParams $dto
     *
     * @return mixed
    */
    public function stream(StreamParams $dto): Stream;






    /**
     * @param string $pattern
     * @return FileCollectionInterface
    */
    public function collection(string $pattern): FileCollectionInterface;





    /**
     * @param string $directory
     * @param string $extension
     * @return FileCollectionInterface
    */
    public function collectionFilesFromDirectory(string $directory, string $extension = 'php'): FileCollectionInterface;




    /**
     * @param string $filename
     * @param string $content
     * @return bool
     */
    public function dump(string $filename, string $content): bool;







    /**
     * @return FileLocatorInterface
     */
    public function getFileLocator(): FileLocatorInterface;
}
