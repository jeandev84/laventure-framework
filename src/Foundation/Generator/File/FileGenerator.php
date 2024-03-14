<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\File;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\Generator\FileGeneratorInterface;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Foundation\Application;

/**
 * FileGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Service\Generator\Common
*/
abstract class FileGenerator implements FileGeneratorInterface
{
    /**
     * @param Application $app
     * @param Filesystem $filesystem
     * @param ConfigInterface $config
    */
    public function __construct(
        protected Application $app,
        protected FilesystemInterface $filesystem,
        protected ConfigInterface $config
    ) {
    }




    /**
     * @inheritDoc
    */
    public function generate(): bool
    {
        return $this->dump();
    }




    /**
     * @inheritDoc
    */
    public function generated(): bool
    {
        return $this->file($this->getTargetPath())
                    ->exists();
    }





    /**
     * @inheritDoc
    */
    public function make(): bool
    {
        return $this->filesystem
                    ->file($this->getTargetPath())
                    ->make();
    }





    /**
     * @inheritDoc
    */
    public function dump(): bool
    {
        return $this->filesystem
                    ->file($this->getTargetPath())
                    ->dump($this->getContent());
    }






    /**
     * @inheritDoc
    */
    public function write(): false|int
    {
        return $this->filesystem
                    ->file($this->getTargetPath())
                    ->write($this->getContent());
    }





    /**
     * @inheritDoc
    */
    public function append(): false|int
    {
        return $this->filesystem
                    ->file($this->getTargetPath())
                    ->append($this->getContent());
    }






    /**
     * @inheritDoc
    */
    public function generateStub(array $patterns): string
    {
        $file    = $this->file($this->getStubPath());
        $patterns["ApplicationName"] = $this->app->getName();
        $patterns["GenerateTime"]    = date('d/m/Y H:i:s');

        return $file->stub($patterns);
    }





    /**
     * @param $path
     * @return File
    */
    public function file($path): File
    {
        return new File($path);
    }






    /**
     * @param array $parts
     * @return string
    */
    public function generatePathPHP(array $parts): string
    {
        return join(DIRECTORY_SEPARATOR, $parts). ".php";
    }





    /**
     * @param $path
     * @return string
    */
    public function trimPath($path): string
    {
        return trim($path, DIRECTORY_SEPARATOR);
    }




    /**
     * @param string $path
     * @return array
    */
    public function convertPathToArray(string $path): array
    {
        return explode("/", $path);
    }





    /**
     * @param string $path
     * @return string
    */
    public function getLastPartOfPath(string $path): string
    {
        return $this->getLastElementOfArray(
            $this->convertPathToArray($path)
        );
    }




    /**
     * @param array $array
     * @return mixed
    */
    public function getLastElementOfArray(array $array): string
    {
        return strval(end($array));
    }






    /**
      * @inheritDoc
     */
    abstract public function getStubPath(): string;
}
