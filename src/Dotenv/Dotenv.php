<?php

declare(strict_types=1);

namespace Laventure\Dotenv;

use Laventure\Component\Filesystem\File\Locator\FileLocator;
use Laventure\Dotenv\Collection\EnvironmentCollection;
use Laventure\Dotenv\Collection\EnvironmentCollectionInterface;
use Laventure\Dotenv\Export\DotenvExporter;
use Laventure\Dotenv\Loader\DotenvLoader;

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
     * @var EnvironmentCollectionInterface
    */
    protected EnvironmentCollectionInterface $environment;


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
        $this->environment  = new EnvironmentCollection();
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
    public function getEnvironment(): EnvironmentCollectionInterface
    {
        return $this->environment;
    }
}
