<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File;

use Laventure\Component\Filesystem\Utils\DirectoryMaker;
use Laventure\Component\Filesystem\File\Contract\FileInterface;
use Laventure\Component\Filesystem\File\Exception\FileException;
use Laventure\Component\Filesystem\File\Info\FileInfo;
use Laventure\Component\Filesystem\File\Loader\FileLoader;
use Laventure\Component\Filesystem\File\Reader\FileReader;
use Laventure\Component\Filesystem\File\Uploader\FileUploader;
use Laventure\Component\Filesystem\File\Writer\FileWriter;

/**
 * File
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common
*/
class File implements FileInterface
{
    /**
     * @var string
    */
    protected string $path;


    /**
     * @var FileReader
    */
    protected FileReader $reader;


    /**
     * @var FileLoader $loader
    */
    protected FileLoader $loader;



    /**
     * @var FileUploader
    */
    protected FileUploader $uploader;



    /**
     * @var FileWriter
    */
    protected FileWriter $writer;



    /**
     * @param string $path
    */
    public function __construct(string $path)
    {
        $this->path     = $path;
        $this->reader   = new FileReader($path);
        $this->loader   = new FileLoader($path);
        $this->uploader = new FileUploader($path);
        $this->writer   = new FileWriter($path);
    }



    /**
     * @inheritDoc
    */
    public function exists(): bool
    {
        return file_exists($this->path);
    }




    /**
     * @inheritDoc
    */
    public function load(): mixed
    {
        if (! $this->exists()) {
            throw new FileException("Could not load file $this->path");
        }

        return $this->loader->load();
    }





    /**
     * @inheritdoc
    */
    public function makeDir(): bool
    {
        $dirname = $this->dir();

        return DirectoryMaker::make($dirname);
    }





    /**
     * @inheritDoc
    */
    public function make(): bool
    {
        $this->makeDir();

        return touch($this->getPath());
    }





    /**
     * @inheritDoc
    */
    public function dir(): string
    {
        return $this->info()->getPath();
    }




    /**
     * @inheritDoc
    */
    public function read(): string
    {
        if (!$this->exists()) {
            throw new FileException("Could not read file $this->path");
        }

        return $this->reader->read();
    }




    /**
     * @inheritDoc
    */
    public function readAsArray(): array
    {
        return $this->reader->readAsArray();
    }





    /**
     * @inheritDoc
    */
    public function write(string $content, int $flags = 0): false|int
    {
        return $this->writer
                    ->flags($flags)
                    ->content($content)
                    ->write();
    }




    /**
     * @param string $content
     * @return false|int
    */
    public function append(string $content): false|int
    {
        return $this->write(
            $content . PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }




    /**
     * @inheritDoc
    */
    public function rewrite(string $content): bool|int
    {
        $this->remove();

        return $this->write($content);
    }




    /**
     * @inheritDoc
    */
    public function copyTo(string $destination, $context = null): bool
    {
        return $this->uploader->from($this->getPath())
                              ->to($destination)
                              ->copy($context);
    }




    /**
     * @inheritDoc
    */
    public function moveTo(string $destination): bool
    {
        return $this->uploader->from($this->getPath())
                              ->to($destination)
                              ->upload();
    }




    /**
     * @inheritDoc
    */
    public function stub(array $patterns): string
    {
        $searched = array_keys($patterns);
        $replaced = array_values($patterns);

        return (string) str_replace($searched, $replaced, $this->read());
    }




    /**
     * @inheritDoc
    */
    public function remove(): bool
    {
        if (! $this->exists()) {
            return false;
        }

        return unlink($this->getPath());
    }




    /**
     * @inheritDoc
    */
    public function dump(string $content): bool
    {
        $this->make();
        $this->write($content);
        return !empty($this->read());
    }




    /**
     * @inheritDoc
    */
    public function info(): FileInfo
    {
        return new FileInfo($this->getPath());
    }




    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }





    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->info()->toArray()['filename'];
    }






    /**
     * @return FileLoader
    */
    public function getLoader(): FileLoader
    {
        return $this->loader;
    }





    /**
     * @return FileReader
    */
    public function getReader(): FileReader
    {
        return $this->reader;
    }




    /**
     * @return FileUploader
    */
    public function getUploader(): FileUploader
    {
        return $this->uploader;
    }




    /**
     * @return FileWriter
    */
    public function getWriter(): FileWriter
    {
        return $this->writer;
    }
}
