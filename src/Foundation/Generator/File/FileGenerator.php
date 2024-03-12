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
    )
    {
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
    public function generatedFile(): bool
    {
        return $this->file($this->getTargetPath())
                    ->exists();
    }





    /**
     * @return mixed
    */
    public function make(): mixed
    {
        return $this->filesystem
                    ->file($this->getTargetPath())
                    ->make();
    }





    /**
     * @return mixed
    */
    public function dump(): mixed
    {
        return $this->filesystem
                    ->file($this->getTargetPath())
                    ->dump($this->getContent());
    }




    /**
     * @return false|int
    */
    public function write(): false|int
    {
        return $this->filesystem
                    ->file($this->getTargetPath())
                    ->write($this->getContent());
    }





    /**
     * @return false|int
    */
    public function append(): false|int
    {
        return $this->filesystem
                    ->file($this->getTargetPath())
                    ->append($this->getContent());
    }






    /**
     * @param array $patterns
     * @return string
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
      * @return string
     */
     abstract public function getStubPath(): string;
}