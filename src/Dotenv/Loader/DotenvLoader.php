<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Loader;

use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\Traits\HasFileTrait;
use Laventure\Dotenv\Collection\EnvironmentCollectionInterface;
use Laventure\Dotenv\Exception\DotenvException;
use Laventure\Dotenv\Traits\HasCollectionTrait;

/**
 * DotenvLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Dotenv\Loader
*/
class DotenvLoader implements DotenvLoaderInterface
{
    use HasCollectionTrait;
    use HasFileTrait;


    /**
     * @param EnvironmentCollectionInterface $environment
    */
    public function __construct(EnvironmentCollectionInterface $environment)
    {
        $this->withCollection($environment);
    }




    /**
     * @inheritdoc
    */
    public function load(): bool
    {
        $this->loadFromArray($this->process());

        return !$this->collection->empty();
    }




    /**
     * @param array $data
     * @return void
    */
    public function loadFromArray(array $data): void
    {
        foreach ($data as $env) {
            if (stripos($env, '#') !== false) {
                continue;
            }
            $this->collection->put($env);
        }
    }







    /**
     * @return array
    */
    private function process(): array
    {
        $file = new File($this->file);

        if (!$file->exists()) {
            throw new DotenvException("file $this->file does not exist.");
        }

        $envs = $file->readAsArray();

        if (empty($envs)) {
            throw new DotenvException("empty contents for '$this->file'");
        }

        return $envs;
    }
}
