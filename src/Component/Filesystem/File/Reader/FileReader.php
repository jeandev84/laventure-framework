<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Reader;

use Laventure\Component\Filesystem\File\Reader\Contract\FileReaderInterface;
use Laventure\Component\Filesystem\File\Traits\HasFileTrait;

/**
 * FileReader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Writer
 */
class FileReader implements FileReaderInterface
{
    use HasFileTrait;


    /**
     * @param string $file
    */
    public function __construct(string $file = '')
    {
        $this->setFile($file);
    }




    /**
     * @inheritDoc
    */
    public function readAsArray(): array
    {
        $flags = FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES;

        $data  = file($this->file, $flags);

        return $data ?: [];
    }





    /**
     * @inheritDoc
    */
    public function read(): string
    {
        return strval(file_get_contents($this->file));
    }
}
