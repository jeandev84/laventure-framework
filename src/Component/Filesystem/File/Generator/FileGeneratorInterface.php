<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Generator;

use Laventure\Contract\Generator\GeneratorInterface;

/**
 * FileGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\Generator
*/
interface FileGeneratorInterface extends GeneratorInterface
{
    /**
     * Returns base directory
     *
     * @return string
    */
    public function getBaseDir(): string;




    /**
     * Returns target path
     *
     * @return string
    */
    public function getTargetPath(): string;






    /**
     * Returns content
     *
     * @return string
    */
    public function getContent(): string;






    /**
     * Determine if file successfully generated
     *
     * @return bool
    */
    public function generated(): bool;








    /**
     * Make only the file [create a directory if not exists]
     *
     * @return bool
    */
    public function make(): bool;





    /**
     * Make file and put content inside file
     *
     * @return bool
    */
    public function dump(): bool;





    /**
     * Make only file in existent directory
     *
     * @return false|int
    */
    public function write(): false|int;







    /**
     * Add content to the previous
     *
     * @return false|int
    */
    public function append(): false|int;







    /**
     * Returns stub path
     *
     * @return string
    */
    public function getStubPath(): string;







    /**
     * Generate stub
     *
     * @param array $patterns
     * @return string
    */
    public function generateStub(array $patterns): string;
}
