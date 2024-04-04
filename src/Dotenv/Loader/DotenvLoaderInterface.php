<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Loader;

use Laventure\Component\Filesystem\File\Contract\HasFileInterface;
use Laventure\Component\Filesystem\File\Loader\Contract\FileLoaderInterface;
use Laventure\Contract\Export\ExportInterface;
use Laventure\Contract\Loader\LoaderInterface;
use Laventure\Contract\Matcher\MatcherInterface;
use Laventure\Dotenv\Contract\HasEnvironments;
use Laventure\Dotenv\Contract\HasExportInterface;

/**
 * DotenvLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Loader
*/
interface DotenvLoaderInterface extends LoaderInterface
{
}
