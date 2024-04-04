<?php

declare(strict_types=1);

namespace Laventure\Foundation\Debug\Logger\Writer\DTO;

/**
 * LoggerWriterDto
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Debug\Logger\Writer\DTO
*/
class LoggerWriterDto
{
    public function __construct(
        public string $date,
        public string $logPath,
        public string $environment
    ) {
    }
}
