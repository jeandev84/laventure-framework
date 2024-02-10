<?php

declare(strict_types=1);

namespace Laventure\Dotenv;

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
     * @var DotenvLoader
    */
    private DotenvLoader $loader;


    /**
     * @var EnvironmentInterface
    */
    private EnvironmentInterface $environment;



    /**
     * @var string
    */
    private string $basePath;



    /**
     * @param string $basePath
    */
    public function __construct(string $basePath)
    {
        $this->basePath    = $basePath;
        $this->environment = Environment::getInstance();
    }




    /**
     * @inheritDoc
    */
    public function load(): bool
    {
        $loader = new DotenvLoader(
            $this->locateFile('.env')
        );

        return $loader->load();
    }




    /**
     * @param string $destination
     * @return mixed
    */
    public function export(string $destination): bool
    {
        $export = new DotenvExporter($destination);

        return $export->export();
    }




    /**
     * @return EnvironmentInterface
    */
    public function getEnvironment(): EnvironmentInterface
    {
        return $this->environment;
    }


    /**
     * @return string
    */
    public function getBasePath(): string
    {
        return $this->basePath;
    }



    /**
     * @param string $file
     * @return string
     */
    public function locateFile(string $file): string
    {
        return $this->basePath . DIRECTORY_SEPARATOR . $file;
    }
}
