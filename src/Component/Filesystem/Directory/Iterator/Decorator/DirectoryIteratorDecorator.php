<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Iterator\Decorator;

use DirectoryIterator;
use Laventure\Component\Filesystem\Directory\Iterator\Decorator\Contract\DirectoryIteratorDecoratorInterface;
use SeekableIterator;

/**
 * DirectoryIteratorDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory\Iterator\Decorator
*/
class DirectoryIteratorDecorator implements DirectoryIteratorDecoratorInterface
{
    /**
     * @var DirectoryIterator
    */
    protected DirectoryIterator $iterator;


    /**
     * @param string $directory
    */
    public function __construct(string $directory)
    {
        $this->iterator = new DirectoryIterator($directory);
    }



    /**
     * @inheritDoc
    */
    public function current(): string
    {
        return $this->iterator->getFilename();
    }




    /**
     * @inheritDoc
    */
    public function next(): void
    {
        $this->iterator->next();
    }



    /**
     * @inheritDoc
    */
    public function key(): mixed
    {
        return $this->iterator->key();
    }




    /**
     * @inheritDoc
    */
    public function valid(): bool
    {
        if($this->iterator->valid()) {
            if (! $this->iterator->isDir()) {
                $this->iterator->next();
                return $this->valid();
            }
            return true;
        }
        return false;
    }



    /**
     * @inheritDoc
    */
    public function rewind(): void
    {
        $this->iterator->rewind();
    }




    /**
     * @inheritDoc
    */
    public function seek(int $offset): void
    {
        $this->iterator->seek($offset);
    }




    /**
     * @inheritDoc
    */
    public function getIterator(): DirectoryIterator
    {
        return $this->iterator;
    }
}
