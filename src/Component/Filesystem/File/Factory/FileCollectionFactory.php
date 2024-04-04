<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Factory;

use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Component\Filesystem\File\File;

/**
 * FileCollectionFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Factory
 */
class FileCollectionFactory
{
    /**
     * @param File[] $files
     *
     * @return FileCollection
    */
    public function create(array $files): FileCollection
    {
        return new FileCollection($files);
    }
}
