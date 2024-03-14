<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Iterator\Contract;

/**
 * DirectoryIteratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory\Iterator\Writer
*/
interface DirectoryIteratorInterface
{
    public function iterate(): mixed;
}
