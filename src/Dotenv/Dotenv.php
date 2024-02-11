<?php

declare(strict_types=1);

namespace Laventure\Dotenv;

use Laventure\Component\Filesystem\File\Locator\FileLocator;
use Laventure\Dotenv\Contract\DotenvInterface;
use Laventure\Dotenv\Contract\EnvironmentInterface;
use Laventure\Dotenv\Contract\HasEnvironments;
use Laventure\Dotenv\Export\DotenvExporter;
use Laventure\Dotenv\Export\DotenvExporterInterface;
use Laventure\Dotenv\Loader\DotenvLoader;
use Laventure\Dotenv\Loader\DotenvLoaderInterface;

/**
 * Dotenv
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv
 */
class Dotenv implements DotenvInterface
{
    /**
     * @var FileLocator
    */
    protected FileLocator $locator;


    /**
     * @var EnvironmentInterface
    */
    private EnvironmentInterface $environment;




    /**
     * @param string $basePath
    */
    public function __construct(string $basePath)
    {
        $this->locator      = new FileLocator($basePath);
        $this->environment  = new Environment();
    }




    /**
     * @inheritDoc
    */
    public function load(): bool
    {
        $loader = new DotenvLoader(
            $this->locator->locate('.env'),
            $this->environment
        );

        return $loader->load();
    }




    /**
     * @param string $destination
     * @return mixed
    */
    public function export(string $destination): bool
    {
        $export = new DotenvExporter(
            $destination,
            $this->environment
        );

        return $export->export();
    }
}
