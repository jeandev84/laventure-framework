<?php
declare(strict_types=1);

namespace Laventure\Foundation\Service\Generator;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Component\Filesystem\FilesystemInterface;

/**
 * FileGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Service\Generator
*/
abstract class FileGenerator implements FileGeneratorInterface
{

    /**
     * @param Filesystem $filesystem
     * @param ConfigInterface $config
     */
    public function __construct(
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
        return boolval($this->write());
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
        $file = new File($this->getStubPath());
        return $file->stub($patterns);
    }




     /**
      * @return string
     */
     abstract public function getStubPath(): string;
}