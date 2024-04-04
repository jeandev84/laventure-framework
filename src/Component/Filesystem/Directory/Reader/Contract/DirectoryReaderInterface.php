<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Reader\Contract;

use Laventure\Component\Filesystem\Directory\Contract\HasDirectoryInterface;
use Laventure\Contract\Reader\ReaderInterface;

/**
 * DirectoryReaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory\Writer\Writer
 */
interface DirectoryReaderInterface extends ReaderInterface, HasDirectoryInterface
{
}
