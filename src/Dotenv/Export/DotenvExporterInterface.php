<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Export;

use Laventure\Component\Filesystem\File\Contract\HasFileInterface;
use Laventure\Contract\Export\ExportInterface;
use Laventure\Contract\Loader\LoaderInterface;
use Laventure\Dotenv\Contract\HasEnvironments;

/**
 * DotenvExporterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Export
 */
interface DotenvExporterInterface extends ExportInterface, HasFileInterface
{
}
