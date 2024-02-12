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
    protected EnvironmentInterface $environment;


    /**
     * @var DotenvLoader
    */
    protected DotenvLoader $loader;


    /**
     * @var DotenvExporter
    */
    protected DotenvExporter $exporter;


    /**
     * @param string $basePath
    */
    public function __construct(string $basePath)
    {
        $this->environment  = new Environment();
        $this->locator      = new FileLocator($basePath);
        $this->loader       = new DotenvLoader($this->environment);
        $this->exporter     = new DotenvExporter($this->environment);
    }




    /**
     * @inheritDoc
    */
    public function load(): bool
    {
        $this->loader->setFile($this->locator->locate(self::FILENAME));

        return $this->loader->load();
    }




    /**
     * @inheritDoc
    */
    public function withExportPath(string $destination): static
    {
        $this->exporter->setFile($destination);

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function export(): bool
    {
        return $this->exporter->export();
    }




    /**
     * @inheritdoc
    */
    public function getEnvironment(): EnvironmentInterface
    {
        return $this->environment;
    }
}
