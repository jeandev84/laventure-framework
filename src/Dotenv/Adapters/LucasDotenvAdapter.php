<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Adapters;

use Laventure\Dotenv\Collection\EnvironmentCollection;
use Laventure\Dotenv\Collection\EnvironmentCollectionInterface;
use Laventure\Dotenv\DotenvInterface;

/**
 * LucasDotenvAdapter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Adapters
 */
class LucasDotenvAdapter implements DotenvInterface
{
    /**
     * @inheritDoc
    */
    public function load(): bool
    {
        return false;
    }



    /**
     * @inheritDoc
    */
    public function withExportPath(string $destination): static
    {
        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getCollection(): EnvironmentCollectionInterface
    {
        return new EnvironmentCollection();
    }



    /**
     * @inheritDoc
    */
    public function export(): bool
    {
        return false;
    }
}
