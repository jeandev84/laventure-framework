<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Reader;

use Laventure\Component\Filesystem\Directory\Reader\Contract\DirectoryReaderInterface;
use Laventure\Component\Filesystem\Directory\Traits\HasDirectoryTrait;

/**
 * DirectoryReader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Writer
 */
class DirectoryReader implements DirectoryReaderInterface
{
    use HasDirectoryTrait;



    /**
     * @param string $directory
    */
    public function __construct(string $directory)
    {
        $this->setDirectory($directory);
    }




    /**
     * @inheritDoc
    */
    public function read(): array|false
    {
        return glob($this->directory);
    }
}
