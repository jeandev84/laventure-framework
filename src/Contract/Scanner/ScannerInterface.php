<?php

declare(strict_types=1);

namespace Laventure\Contract\Scanner;

/**
 * ScannerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Scanner
 */
interface ScannerInterface
{
    /**
     * Scan something from file may be
     *
     * @return mixed
    */
    public function scan(): mixed;
}
