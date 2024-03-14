<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Info;

/**
 * FileInfoInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Info
*/
interface FileInfoInterface
{
    /**
     * Returns file infos as array
     *
     * @return array
    */
    public function toArray(): array;
}
