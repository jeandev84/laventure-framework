<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Recursion;

use Laventure\Component\Filesystem\Directory\Contract\HasDirectoryInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * RecursiveDirectory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory\Recursive
*/
class RecursionDirectory implements HasDirectoryInterface
{
    /**
     * @var string
    */
    protected string $directory;


    /**
     * @var RecursiveDirectoryIterator
    */
    protected RecursiveDirectoryIterator $directoryIterator;



    /**
     * @var RecursiveIteratorIterator
    */
    protected RecursiveIteratorIterator $recursiveIterator;



    /**
     * @param string $directory
    */
    public function __construct(string $directory)
    {
        $this->directoryIterator = new RecursiveDirectoryIterator($directory);
        $this->recursiveIterator = new RecursiveIteratorIterator($this->directoryIterator);
        $this->directory         = $directory;
    }



    /**
     * @return RecursiveDirectoryIterator
    */
    public function getDirectoryIterator(): RecursiveDirectoryIterator
    {
        return $this->directoryIterator;
    }




    /**
     * @return RecursiveIteratorIterator
    */
    public function getRecursiveIterator(): RecursiveIteratorIterator
    {
        return $this->recursiveIterator;
    }




    /**
     * @inheritdoc
    */
    public function getDirectory(): string
    {
        return $this->directory;
    }

}
