<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Loader\Contract;

use Laventure\Component\Filesystem\File\Contract\HasFileInterface;
use Laventure\Contract\Loader\LoaderInterface;

/**
 * FileLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Loader\Writer
*/
interface FileLoaderInterface extends LoaderInterface, HasFileInterface
{
}
