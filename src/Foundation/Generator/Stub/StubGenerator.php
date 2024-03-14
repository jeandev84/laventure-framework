<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Stub;

use Laventure\Component\Filesystem\File\Exception\FileException;
use Laventure\Component\Filesystem\File\Reader\Contract\FileReaderInterface;

/**
 * StubGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Stub
*/
class StubGenerator implements StubGeneratorInterface
{
    /**
     * @var array
    */
    protected array $patterns = [];






    /**
     * @param FileReaderInterface $fileReader
    */
    public function __construct(protected FileReaderInterface $fileReader)
    {

    }





    /**
     * @inheritDoc
    */
    public function withPatterns(array $patterns): static
    {
        $this->patterns = array_merge($this->patterns, $patterns);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
        return $this->fileReader->getFile();
    }




    /**
     * @inheritDoc
    */
    public function generate(): string
    {
        if (!$this->getStubPath()) {
            throw new FileException("Empty stub path.");
        }

        $searched = array_keys($this->patterns);
        $replaced = array_values($this->patterns);

        return (string) str_replace(
            $searched,
            $replaced,
            $this->fileReader->read()
        );
    }
}
