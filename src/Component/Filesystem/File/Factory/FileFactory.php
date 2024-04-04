<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Factory;

use Laventure\Component\Filesystem\File\File;

/**
 * FileFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Factory
 */
class FileFactory
{
    /**
     * @param string $path
     *
     * @return File
    */
    public function create(string $path): File
    {
        return new File($path);
    }




    /**
     * @param string[] $files
     *
     * @return array
    */
    public function createFromArray(array $files): array
    {
        $collection = [];

        foreach ($files as $file) {
            $collection[] = $this->create($file);
        }

        return $collection;
    }
}
