<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem;

use Laventure\Component\Filesystem\Stream\DTO\StreamParams;

/**
 * FilesystemInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem
 */
interface FilesystemInterface
{
    /**
     * set base path
     *
     * @param string $path
     *
     * @return mixed
    */
    public function setBasePath(string $path): mixed;



    /**
     * locate path
     *
     * @param string $path
     * @return mixed
    */
    public function locate(string $path): mixed;



    /**
     * @param string $pattern
     *
     * @return array
    */
    public function resources(string $pattern): mixed;





    /**
     * @param string $filename
     * @return mixed
    */
    public function file(string $filename): mixed;



    /**
     * @param string $directory
     * @return mixed
    */
    public function dir(string $directory): mixed;



    /**
     * @param StreamParams $dto
     *
     * @return mixed
    */
    public function stream(StreamParams $dto): mixed;




    /**
     * @param string $pattern
     * @return mixed
    */
    public function collection(string $pattern): mixed;
}
