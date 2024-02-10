<?php

declare(strict_types=1);

namespace Laventure\Contract\Download;

/**
 * DownloaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Contract\Download
 */
interface DownloaderInterface
{
    /**
     * @return mixed
    */
    public function download(): mixed;
}
