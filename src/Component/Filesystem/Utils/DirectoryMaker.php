<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Utils;

use Laventure\Component\Filesystem\Directory\Directory;

/**
 * DirectoryMaker
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Utils
 */
class DirectoryMaker
{
    /**
     * @param string $directory
     * @return bool
    */
    public static function make(string $directory): bool
    {
        $directory = new Directory($directory);
        return $directory->make();
    }
}
