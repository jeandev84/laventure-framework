<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Uploader\Contract;

use Laventure\Component\Filesystem\File\Contract\HasFileInterface;
use Laventure\Contract\Uploader\UploaderInterface;

/**
 * FileUploaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Uploader\Writer
 */
interface FileUploaderInterface extends UploaderInterface, HasFileInterface
{
    /**
     * @param string $from
     * @return static
    */
    public function from(string $from): static;



    /**
     * @param string $destination
     * @return FileUploaderInterface
    */
    public function to(string $destination): static;




    /**
     * @param $context
     * @return mixed
    */
    public function copy($context = null): mixed;
}
