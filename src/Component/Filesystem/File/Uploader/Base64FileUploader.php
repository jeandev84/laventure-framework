<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Uploader;

use Laventure\Component\Filesystem\File\Base64\Contract\Base64FileInterface;
use Laventure\Component\Filesystem\File\Base64\Traits\HasBase64Trait;
use Laventure\Component\Filesystem\File\Uploader\Contract\Base64FileUploaderInterface;
use Laventure\Component\Filesystem\File\Writer\Contract\FileWriterInterface;

/**
 * Base64FileUploader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Uploader
*/
class Base64FileUploader implements Base64FileUploaderInterface
{
    use HasBase64Trait;


    /**
     * @var FileWriterInterface
    */
    protected FileWriterInterface $writer;



    /**
     * @param FileWriterInterface $writer
     *
     * @param Base64FileInterface $file
    */
    public function __construct(FileWriterInterface $writer, Base64FileInterface $file)
    {
        $this->writer = $writer;
        $this->withBase64($file);
    }



    /**
     * @inheritDoc
    */
    public function upload(): mixed
    {
        $data = $this->getBase64()->getData();

        return $this->writer->content($data)->write();
    }
}
