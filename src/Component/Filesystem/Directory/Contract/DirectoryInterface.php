<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Contract;

use Laventure\Contract\Scanner\ScannerInterface;

/**
 * DirectoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\Directory\Writer
 */
interface DirectoryInterface extends ScannerInterface
{
    /**
     * @return mixed
    */
    public function info(): mixed;





    /**
     * @return bool
    */
    public function exists(): bool;



    /**
     * @param string $extension
     *
     * @return mixed
    */
    public function iterate(string $extension): mixed;




    /**
     * @return mixed
    */
    public function read(): mixed;




    /**
     * @return string
    */
    public function getPath(): string;





    /**
     * @return mixed
    */
    public function make(): mixed;





    /**
     * Returns all files in directory
     *
     * @param string $extension
     * @return array
    */
    public function getFiles(string $extension = 'php'): array;
}
