<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\FilesDirectory;

use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Component\Filesystem\File\Collection\FileCollectionInterface;
use Laventure\Contract\Loader\LoaderInterface;

/**
 * FilesDirectoryLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\FilesDirectory
 */
interface FilesDirectoryLoaderInterface extends LoaderInterface
{
    /**
     * Collection file mapped
     *
     * @return FileCollectionInterface
    */
    public function getCollection(): FileCollectionInterface;




    /**
     * Namespace prefix
     *
     * @return string
    */
    public function getPrefix(): string;






    /**
     * Directory to scan
     *
     * @return string
    */
    public function getDirectory(): string;
}
