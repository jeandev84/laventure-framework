<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Reader\Contract;

use Laventure\Component\Filesystem\File\Contract\HasFileInterface;
use Laventure\Contract\Reader\ReaderInterface;

/**
 * ReaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Writer\Writer
*/
interface FileReaderInterface extends ReaderInterface, HasFileInterface
{
    /**
     * Read file as array
     *
     * @return array
    */
    public function readAsArray(): array;
}
