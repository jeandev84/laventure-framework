<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Contract;

use Laventure\Component\Filesystem\Directory\Iterator\DirectoryIterator;
use Laventure\Contract\Scanner\ScannerInterface;
use SplFileInfo;

/**
 * DirectoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory\Writer
 */
interface DirectoryInterface extends ScannerInterface
{
    /**
     * @return SplFileInfo
    */
    public function info(): SplFileInfo;




    /**
     * @param string $extension
     *
     * @return DirectoryIterator
    */
    public function iterate(string $extension): DirectoryIterator;








    /**
     * Returns all files in directory
     *
     * @param string $extension
     * @return array
    */
    public function getFiles(string $extension = 'php'): array;







    /**
     * @return bool
    */
    public function exists(): bool;







    /**
     * @return mixed
    */
    public function read(): mixed;




    /**
     * @return string
    */
    public function getPath(): string;





    /**
     * @return bool
    */
    public function make(): mixed;
}
