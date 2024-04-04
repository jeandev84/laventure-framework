<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Logger\Common;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Stringable;

/**
 * AbstractLogger
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\AbstractLogger\Common
 */
abstract class AbstractLogger implements LoggerInterface
{
    /**
     * @inheritDoc
    */
    public function emergency(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }



    /**
     * @inheritDoc
    */
    public function alert(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }




    /**
     * @inheritDoc
    */
    public function critical(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }





    /**
     * @inheritDoc
    */
    public function error(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }






    /**
     * @inheritDoc
    */
    public function warning(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }







    /**
     * @inheritDoc
    */
    public function notice(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }





    /**
     * @inheritDoc
    */
    public function info(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }





    /**
     * @inheritDoc
    */
    public function debug(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }
}
