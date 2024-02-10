<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Contract;

/**
 * FileInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\File\Writer
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
     * @return mixed
    */
    public function dump(): mixed;






    /**
     * Replace patterns in stub file
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
     * @return mixed
    */
    public function info(): mixed;




    /**
     * Returns file path
     *
     * @return string
    */
    public function getPath(): string;
}
