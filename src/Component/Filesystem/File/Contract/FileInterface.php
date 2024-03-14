<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Contract;

use Laventure\Component\Filesystem\File\Info\FileInfo;

/**
 * FileInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Writer
*/
interface FileInterface
{
    /**
     * Determine if file exist
     *
     * @return bool
    */
    public function exists(): bool;





    /**
     * Load file
     *
     * @return mixed
    */
    public function load(): mixed;






    /**
     * Make file
     *
     * @return mixed
    */
    public function make(): mixed;





    /**
     * Make file directory
     *
     * @return mixed
    */
    public function makeDir(): mixed;





    /**
     * Returns info about directory file
     *
     * @return mixed
    */
    public function dir(): mixed;





    /**
     * Read file
     *
     * @return mixed
     */
    public function read(): mixed;





    /**
     * Returns file data as array
     *
     * @return array
    */
    public function readAsArray(): array;





    /**
     * Write content into file
     *
     * @param string $content
     * @param int $flags
     * @return false|int
    */
    public function write(string $content, int $flags = 0): false|int;





    /**
     * Rewrite file
     *
     * @param string $content
     *
     * @return bool|int
    */
    public function rewrite(string $content): bool|int;







    /**
      * Copy file to given destination
      *
      * @param string $destination
      *
      * @param $context
      *
      * @return bool
     */
    public function copyTo(string $destination, $context = null): bool;






    /**
     * Move file to given destination
     *
     * @param string $destination
     *
     * @return bool
    */
    public function moveTo(string $destination): bool;






    /**
     * @param string $content
     * @return mixed
    */
    public function dump(string $content): mixed;






    /**
     * Replace patterns in stubs file
     *
     * @param array $patterns
     *
     * @return string
    */
    public function stub(array $patterns): string;






    /**
     * Remove file
     *
     * @return bool
    */
    public function remove(): mixed;






    /**
     * @return FileInfo
    */
    public function info(): FileInfo;





    /**
     * Returns file path
     *
     * @return string
    */
    public function getPath(): string;
}
