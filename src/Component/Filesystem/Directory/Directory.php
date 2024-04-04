<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory;

use Laventure\Component\Filesystem\Directory\Contract\DirectoryInterface;
use Laventure\Component\Filesystem\Directory\Info\DirectoryInfo;
use Laventure\Component\Filesystem\Directory\Iterator\DirectoryIterator;
use Laventure\Component\Filesystem\Directory\Reader\DirectoryReader;
use SplFileInfo;

/**
 * Directory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory
*/
class Directory implements DirectoryInterface
{
    /**
     * @var string
    */
    protected string $path;


    /**
     * @var DirectoryReader
    */
    protected DirectoryReader $reader;



    /**
     * @param string $path
    */
    public function __construct(string $path)
    {
        $this->path   = $path;
        $this->reader = new DirectoryReader($path);
    }




    /**
     * @inheritDoc
    */
    public function info(): SplFileInfo
    {
        return new DirectoryInfo($this->path);
    }



    /**
     * @inheritDoc
    */
    public function iterate(string $extension): DirectoryIterator
    {
        return new DirectoryIterator($this->path, $extension);
    }






    /**
     * @inheritDoc
    */
    public function getFiles(string $extension = 'php'): array
    {
        $iterator  = $this->iterate($extension);
        $recursionIterator = $iterator->getRecursion()->getRecursiveIterator();

        $files = [];

        foreach ($recursionIterator as $file) {
            if (!$file->isDir()) {
                $files[] = $file->getPathname();
            }
        }

        return $files;
    }





    /**
     * @inheritdoc
    */
    public function scan(): array|false
    {
        if (!$this->exists()) {
            return false;
        }

        return scandir($this->path);
    }





    /**
     * @inheritDoc
    */
    public function make(): bool
    {
        if ($this->exists()) {
            return true;
        }

        return mkdir($this->path, 0777, true);
    }





    /**
     * @inheritDoc
    */
    public function exists(): bool
    {
        return $this->info()->isDir();
    }





    /**
     * @inheritDoc
    */
    public function read(): mixed
    {
        return $this->reader->read();
    }




    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }
}
