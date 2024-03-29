<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Contract;

/**
 * HasDirectoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory\Writer
 */
interface HasDirectoryInterface
{
    /**
     * @return string
    */
    public function getDirectory(): string;
}
