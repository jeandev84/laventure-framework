<?php

declare(strict_types=1);

namespace PHPUnitTest\Component\Debug\Logger;

use Laventure\Component\Debug\Logger\Logger;
use Laventure\Foundation\Debug\Logger\Writer\DTO\LoggerWriterDto;
use Laventure\Foundation\Debug\Logger\Writer\LoggerWriter;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

/**
 * LoggerTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Debug\Logger
 */
class LoggerTest extends TestCase
{
    public function testItLog(): void
    {

        #$dto     = new LoggerWriterDto(date('Y-m-d H:i:s'), __DIR__.'/storage/log', 'dev');
        #$dto     = new LoggerWriterDto(date('Y-m-d H:i:s'), __DIR__.'/storage/log', 'local');
        #$dto     = new LoggerWriterDto(date('Y-m-d H:i:s'), __DIR__.'/storage/log', 'prod');
        $dto     = new LoggerWriterDto(date('Y-m-d H:i:s'), __DIR__.'/temp/log', 'test');
        $writer  = new LoggerWriter($dto);
        $logger  = new Logger($writer);

        $logger->log(LogLevel::NOTICE, 'something went wrong', [
            'data' => ['file' => __FILE__]
        ]);

        $this->assertFileExists($writer->getLogPath());
    }
}
