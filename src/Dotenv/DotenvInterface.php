<?php

declare(strict_types=1);

namespace Laventure\Dotenv;

use Laventure\Contract\Export\ExportInterface;
use Laventure\Contract\Loader\LoaderInterface;
use Laventure\Dotenv\Collection\EnvironmentCollectionInterface;

/**
 * DotenvInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv
 */
interface DotenvInterface extends LoaderInterface, ExportInterface
{
    public const FILENAME = '.env';


    /**
     * @param string $destination
     * @return $this
    */
    public function withExportPath(string $destination): static;



    /**
     * @return EnvironmentCollectionInterface
    */
    public function getCollection(): EnvironmentCollectionInterface;
}
