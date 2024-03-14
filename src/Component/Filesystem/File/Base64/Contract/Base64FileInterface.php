<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Base64\Contract;

/**
 * Base64FileInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Base64\Writer
 */
interface Base64FileInterface
{
    /**
     * Returns encoded string
     *
     * @return string
    */
    public function getEncodedString(): string;




    /**
     * @param bool $strict
     * @return string
    */
    public function decode(bool $strict = false): string;




    /**
     * Determine if encoded string if valid
     *
     * @return bool
    */
    public function valid(): bool;




    /**
     * Returns data
     *
     * @return string
    */
    public function getData(): string;




    /**
     * Returns extension
     *
     * @return string
    */
    public function getExtension(): string;




    /**
     * Returns data size
     *
     * @return int|mixed
    */
    public function getSize(): mixed;





    /**
     * Returns mime type
     *
     * @return string|mixed
    */
    public function getClientMimeType(): mixed;
}
