<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Loader;

use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Contract\Loader\LoaderInterface;

/**
 * ArrayLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Loader
 */
class ArrayLoader implements LoaderInterface
{
    /**
     * @var FileCollection
    */
    protected FileCollection $files;


    /**
     * @param FileCollection $files
    */
    public function __construct(FileCollection $files)
    {
        $this->files = $files;
    }



    /**
     * @inheritDoc
    */
    public function load(): array
    {
        $data = [];
        foreach ($this->files->getFiles() as $file) {
            $data[$file->getName()] = $file->load();
        }

        return $data;
    }
}
