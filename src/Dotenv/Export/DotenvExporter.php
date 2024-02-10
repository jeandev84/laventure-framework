<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Export;

use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\Traits\HasFileTrait;
use Laventure\Dotenv\Contract\EnvironmentInterface;
use Laventure\Dotenv\Environment;
use Laventure\Dotenv\Exception\DotenvException;
use Laventure\Dotenv\Exception\WrongProcessException;
use Laventure\Dotenv\Traits\HasEnvironmentsTrait;

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
    use HasEnvironmentsTrait;

    /**
     * @var string
    */
    protected string $file;




    /**
     * @param string $file
     * @param EnvironmentInterface|null $environment
    */
    public function __construct(string $file, EnvironmentInterface $environment = null)
    {
        $this->setFile($file);
        $this->withEnvironments($environment ?: Environment::getInstance());
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
