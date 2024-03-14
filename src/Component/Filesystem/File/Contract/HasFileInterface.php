<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Contract;

/**
 * HasFileInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Writer
 */
interface HasFileInterface
{
    /**
     * @return string
    */
    public function getFile(): string;




    /**
     * @return bool
    */
    public function hasFile(): bool;
}
