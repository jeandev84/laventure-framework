<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Iterator\Decorator\Contract;

use DirectoryIterator;
use SeekableIterator;

/**
 * DirectoryIteratoryDecoratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory\Iterator\Decorator\Writer
 */
interface DirectoryIteratorDecoratorInterface extends SeekableIterator
{
    /**
     * @return DirectoryIterator
    */
    public function getIterator(): DirectoryIterator;
}
