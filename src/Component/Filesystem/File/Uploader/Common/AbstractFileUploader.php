<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Uploader\Common;

use Laventure\Component\Filesystem\File\Traits\HasFileTrait;
use Laventure\Component\Filesystem\File\Uploader\Contract\FileUploaderInterface;

/**
 * AbstractFileUploader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Uploader\Common
 */
abstract class AbstractFileUploader implements FileUploaderInterface
{
    use HasFileTrait;


    /**
     * @var string
     */
    protected string $from;


    /**
     * @var string
    */
    protected string $destination;




    /**
     * @param string $file
    */
    public function __construct(string $file)
    {
        $this->setFile($file);
    }



    /**
     * @inheritDoc
    */
    public function from(string $from): static
    {
        $this->from = $from;

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function to(string $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

}
