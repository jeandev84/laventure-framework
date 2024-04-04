<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Logger;

use Laventure\Component\Debug\Logger\Common\AbstractLogger;
use Laventure\Component\Debug\Logger\Exception\InvalidLogLevelArgument;
use Laventure\Component\Debug\Logger\Writer\LoggerWriterInterface;
use Psr\Log\LogLevel;
use ReflectionClass;
use Stringable;

/**
 * Logger
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Logger
*/
class Logger extends AbstractLogger
{
    /**
     * @var LoggerWriterInterface
    */
    protected LoggerWriterInterface $writer;


    /**
     * @param LoggerWriterInterface $writer
    */
    public function __construct(LoggerWriterInterface $writer)
    {
        $this->writer = $writer;
    }




    /**
     * @inheritDoc
    */
    public function log($level, Stringable|string $message, array $context = []): void
    {
        $object = new ReflectionClass(LogLevel::class);
        $validLogLevelsArray = $object->getConstants();

        if(!in_array($level, $validLogLevelsArray)) {
            throw new InvalidLogLevelArgument($level, $validLogLevelsArray);
        }

        $this->writer->level($level)
                     ->message($message)
                     ->context($context)
                     ->write();
    }
}
