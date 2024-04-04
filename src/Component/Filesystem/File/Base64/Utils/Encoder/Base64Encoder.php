<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Base64\Utils\Encoder;

/**
 * Base64Encoder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Base64FileFile\Utils\Encoder
 */
class Base64Encoder
{
    /**
     * @param string $str
     * @return string
    */
    public static function encode(string $str): string
    {
        return base64_encode($str);
    }




    /**
     * @param string $str
     * @param bool $strict
     * @return string
    */
    public static function decode(string $str, bool $strict = false): string
    {
        return strval(base64_decode($str, $strict));
    }
}
