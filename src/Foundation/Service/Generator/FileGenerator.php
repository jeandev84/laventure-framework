<?php
declare(strict_types=1);

namespace Laventure\Foundation\Service\Generator;

use Laventure\Component\Filesystem\Filesystem;

/**
 * FileGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Service\Generator
*/
class FileGenerator implements FileGeneratorInterface
{


    /**
     * Target path
     *
     * @var string|null
    */
    protected ?string $targetPath = null;




    /**
     * File content
     *
     * @var string|null
    */
    protected ?string $content = null;




    /**
     * @param Filesystem $filesystem
    */
    public function __construct(protected Filesystem $filesystem)
    {
    }



    /**
     * @inheritDoc
    */
    public function withTargetPath($path): static
    {
         $this->targetPath = $path;

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function withContent($content): static
    {
         $this->content = $content;

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function getTargetPath(): string
    {
        return $this->targetPath;
    }





    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        // TODO: Implement getContent() method.
    }




    /**
     * @inheritDoc
    */
    public function generate(): mixed
    {

    }


}