<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Logger\Common;

use Psr\Log\LoggerInterface;

/**
 * LoggerAwareTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Logger\Common
*/
trait LoggerAwareTrait
{
    /**
     * @var LoggerInterface
    */
    protected LoggerInterface $logger;


    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     * @return void
    */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }




    /**
     * Returns logger
     *
     * @return LoggerInterface
    */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}
