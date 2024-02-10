<?php

declare(strict_types=1);

namespace Laventure\Foundation\Debug\Logger\Writer;

use Laventure\Component\Container\Container;
use Laventure\Component\Debug\Logger\Writer\AbstractLoggerWriter;
use Laventure\Component\Filesystem\File\File;
use Laventure\Foundation\Debug\Logger\Writer\DTO\LoggerWriterDto;

/**
 * LoggerWriter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Debug\Logger\Writer
*/
class LoggerWriter extends AbstractLoggerWriter
{
    /**
     * @var LoggerWriterDto
    */
    protected LoggerWriterDto $dto;


    /**
     * @param LoggerWriterDto $dto
    */
    public function __construct(LoggerWriterDto $dto)
    {
        $this->dto = $dto;
    }




    /**
     * @inheritDoc
    */
    public function write(): false|int
    {
        $file  = new File($this->getLogPath());
        $file->make();
        return $file->append($this->getDetails());
    }




    /**
     * @return string
    */
    public function getDetails(): string
    {
        return sprintf(
            "%s - Level: %s - Message: %s - Context: %s",
            $this->dto->date,
            $this->level,
            $this->message,
            json_encode($this->context)
        );
    }


    /**
     * @return string
    */
    public function getLogPath(): string
    {
        return sprintf(
            "%s/%s-%s.log",
            $this->dto->logPath,
            $this->dto->environment,
            date("j.n.Y")
        );
    }
}
