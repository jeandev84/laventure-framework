<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Uploader;

use Laventure\Component\Filesystem\File\Uploader\Common\AbstractFileUploader;
use Laventure\Component\Filesystem\File\Uploader\Exception\FileUploaderException;

/**
 * FileUploader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Uploader
 */
class FileUploader extends AbstractFileUploader
{
    /**
     * @inheritDoc
    */
    public function upload(): bool
    {
        $this->makeSureHasCredentials();

        return move_uploaded_file($this->from, $this->destination);
    }



    /**
     * @inheritDoc
    */
    public function copy($context = null): bool
    {
        $this->makeSureHasCredentials();

        return copy($this->from, $this->destination, $context);
    }




    /**
     * @return void
    */
    protected function makeSureHasCredentials(): void
    {
        if (!$this->from) {
            throw new FileUploaderException("Could not found from file");
        }

        if (!$this->destination) {
            throw new FileUploaderException("Could not found destination");
        }
    }
}
