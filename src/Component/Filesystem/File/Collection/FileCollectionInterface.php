<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Collection;

/**
 * FileCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\File\Collection
*/
interface FileCollectionInterface
{
    /**
     * @return array
    */
    public function getFiles(): mixed;
}
