<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Loader;

use Laventure\Component\Filesystem\File\Loader\Contract\FileLoaderInterface;
use Laventure\Component\Filesystem\File\Traits\HasFileTrait;

/**
 * FileLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Loader
 */
class FileLoader implements FileLoaderInterface
{
    use HasFileTrait;


    /**
     * @param string $file
    */
    public function __construct(string $file)
    {
        $this->setFile($file);
    }



    /**
     * @inheritDoc
    */
    public function load(): mixed
    {
        return require_once $this->file;
    }
}
