<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Writer;

use Laventure\Component\Filesystem\File\Traits\HasFileTrait;
use Laventure\Component\Filesystem\File\Writer\Contract\FileWriterInterface;

/**
 * FileWriter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Writer
*/
class FileWriter implements FileWriterInterface
{
    use HasFileTrait;


    /**
     * @var int
    */
    protected int $flags;



    /**
     * @var string
    */
    protected string $content;


    /**
     * @param string $file
     * @param int $flags
     * @param $context
    */
    public function __construct(string $file, int $flags = 0, $context = null)
    {
        $this->setFile($file);
        $this->flags($flags);
        $this->context($context);
    }





    /**
     * @inheritDoc
    */
    public function write(): int
    {
        return intval(file_put_contents(
            $this->file,
            $this->content,
            $this->flags,
            $this->context
        ));
    }



    /**
     * @inheritDoc
    */
    public function flags(int $flags): static
    {
        $this->flags = $flags;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function content(string $content): static
    {
        $this->content = $content;

        return $this;
    }
}
