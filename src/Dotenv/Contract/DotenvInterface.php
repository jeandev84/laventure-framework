<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Contract;

use Laventure\Contract\Loader\LoaderInterface;
use Laventure\Dotenv\Export\DotenvExporterInterface;
use Laventure\Dotenv\Loader\DotenvLoaderInterface;

/**
 * DotenvInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Writer
 */
interface DotenvInterface extends LoaderInterface
{
    public const FILENAME = '.env';
}
