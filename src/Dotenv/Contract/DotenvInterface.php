<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Contract;

use Laventure\Contract\Export\ExportInterface;
use Laventure\Contract\Loader\LoaderInterface;


/**
 * DotenvInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Writer
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
     * @return EnvironmentInterface
    */
    public function getEnvironment(): EnvironmentInterface;
}
