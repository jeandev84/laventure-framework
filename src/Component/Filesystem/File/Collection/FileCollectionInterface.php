<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Collection;

use Laventure\Component\Filesystem\File\Contract\FileInterface;

/**
 * FileCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Collection
*/
interface FileCollectionInterface
{
    /**
     * @return FileInterface[]
    */
    public function getFiles(): array;



    /**
     * @return array
    */
    public function getPaths(): array;
}
