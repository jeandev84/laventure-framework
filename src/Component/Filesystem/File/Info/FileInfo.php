<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Info;

use SplFileInfo;

/**
 * FileInfo
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Info
*/
class FileInfo extends SplFileInfo implements FileInfoInterface
{
    /**
     * @inheritDoc
    */
    public function toArray(): array
    {
        return pathinfo($this->getRealPath());
    }
}
