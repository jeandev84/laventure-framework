<?php

declare(strict_types=1);

namespace Laventure\Contract\Reader;

/**
 * ReaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Reader
 */
interface ReaderInterface
{
    /**
     * @return mixed
    */
    public function read(): mixed;
}
