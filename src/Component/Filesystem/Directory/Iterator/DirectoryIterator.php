<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Iterator;

use FilterIterator;
use Iterator;
use Laventure\Component\Filesystem\Directory\Iterator\Contract\DirectoryIteratorInterface;
use Laventure\Component\Filesystem\Directory\Recursion\RecursionDirectory;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * DirectoryIterator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory\Iterator
 */
class DirectoryIterator extends FilterIterator
{
    /**
     * @var string
    */
    protected string $extension;



    /**
     * @var RecursionDirectory
    */
    protected RecursionDirectory $recursion;



    /**
     * @param string $directory
     *
     * @param string $extension
    */
    public function __construct(string $directory, string $extension)
    {
        $this->recursion = new RecursionDirectory($directory);
        $this->extension = $extension;

        parent::__construct($this->recursion->getRecursiveIterator());
    }




    /**
     * @return string
    */
    public function getExtension(): string
    {
        return $this->extension;
    }



    /**
     * @return RecursionDirectory
    */
    public function getRecursion(): RecursionDirectory
    {
        return $this->recursion;
    }





    /**
     * @inheritDoc
    */
    public function accept(): bool
    {
        $extension = pathinfo($this->current(), PATHINFO_EXTENSION);

        return $this->extension === $extension;
    }
}
