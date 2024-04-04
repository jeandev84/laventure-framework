<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Factory;

use Laventure\Component\Filesystem\Directory\Directory;

/**
 * DirectoryFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory\Factory
 */
class DirectoryFactory
{
    /**
     * @param string $directory
     * @return Directory
     */
    public function create(string $directory): Directory
    {
        return new Directory($directory);
    }
}
