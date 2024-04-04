<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Convertor;

use Laventure\Contract\Convertor\ConvertorInterface;

/**
 * FileToClassConvertorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\File\Convertor
 */
interface FileToClassConvertorInterface extends ConvertorInterface
{
    /**
     * @param array $files
     * @return $this
    */
    public function withFiles(array $files): static;





    /**
     * @return array
    */
    public function getFiles(): array;






    /**
     * Returns base directory of file
     * @return string
    */
    public function getBaseDirectory(): string;





    /**
     * Returns base namespace
     *
     * @return string
    */
    public function getBaseNamespace(): string;





    /**
     * Returns base path
     *
     * @return string
    */
    public function getBasePath(): string;






    /**
     * Returns existences classes transformed from files
     *
     * @return array
    */
    public function convert(): array;
}
