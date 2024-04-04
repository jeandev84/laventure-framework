<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Common\Storage;

use SplObjectStorage;

/**
 * ObjectStorage
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Common\Storage
*/
class ObjectStorage extends SplObjectStorage
{
    /**
     * @return int
    */
    public function clear(): int
    {
        return $this->removeAll($this);
    }
}
