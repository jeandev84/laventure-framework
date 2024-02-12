<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Export;

use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\Traits\HasFileTrait;
use Laventure\Dotenv\Contract\EnvironmentInterface;
use Laventure\Dotenv\Environment;
use Laventure\Dotenv\Exception\DotenvException;
use Laventure\Dotenv\Exception\WrongProcessException;
use Laventure\Dotenv\Traits\HasEnvironmentTrait;

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
    use HasEnvironmentTrait;

    /**
     * @var string
    */
    protected string $file;


    /**
     * @param EnvironmentInterface $environment
    */
    public function __construct(EnvironmentInterface $environment)
    {
        $this->withEnvironments($environment);
    }



    /**
     * @inheritDoc
    */
    public function export(): bool
    {
        $file = new File($this->file);

        if ($this->environment->empty()) {
            throw new DotenvException("no data to export");
        }

        if(!$file->make()) {
            throw new WrongProcessException();
        }

        if ($file->exists()) {
            $file->write("");
        }

        foreach ($this->environment->all() as $name => $value) {
            $file->append("$name=$value");
        }

        return !$this->environment->empty();
    }

}
