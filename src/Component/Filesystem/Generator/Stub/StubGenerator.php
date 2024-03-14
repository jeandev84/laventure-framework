<?php
declare(strict_types=1);

namespace Laventure\Component\Filesystem\Generator\Stub;

use Laventure\Component\Filesystem\File\File;

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
     * @var string
    */
    protected string $stubPath;



    /**
     * @var array
    */
    protected array $patterns = [];






    /**
     * @param string $stubPath
    */
    public function __construct(string $stubPath)
    {
        $this->withStubPath($stubPath);
    }




    /**
     * @inheritDoc
    */
    public function withStubPath(string $stubPath): static
    {
        $this->stubPath = $stubPath;

        return $this;
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
    public function generate(): string
    {
        $file = new File($this->stubPath);

        return $file->stub($this->patterns);
    }
}