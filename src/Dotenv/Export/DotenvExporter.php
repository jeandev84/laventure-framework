<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Export;

use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\Traits\HasFileTrait;
use Laventure\Dotenv\Collection\EnvironmentCollectionInterface;
use Laventure\Dotenv\Exception\DotenvException;
use Laventure\Dotenv\Exception\WrongProcessException;
use Laventure\Dotenv\Traits\HasCollectionTrait;

/**
 * DotenvExporter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Export
 */
class DotenvExporter implements DotenvExporterInterface
{
    use HasFileTrait;
    use HasCollectionTrait;


    /**
     * @param EnvironmentCollectionInterface $environment
    */
    public function __construct(EnvironmentCollectionInterface $environment)
    {
        $this->withCollection($environment);
    }



    /**
     * @inheritDoc
    */
    public function export(): bool
    {
        $file = new File($this->file);

        if ($this->collection->empty()) {
            throw new DotenvException("no data to export");
        }

        if(!$file->make()) {
            throw new WrongProcessException();
        }

        if ($file->exists()) {
            $file->write("");
        }

        foreach ($this->collection->all() as $name => $value) {
            $file->append("$name=$value");
        }

        return !$this->collection->empty();
    }

}
