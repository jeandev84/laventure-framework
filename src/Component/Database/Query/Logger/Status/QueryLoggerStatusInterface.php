<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger\Status;

/**
 * QueryLoggerStatusInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Logger\Status
 */
interface QueryLoggerStatusInterface
{
    /**
     * @param bool $loggable
     * @return $this
    */
    public function withLoggableStatus(bool $loggable): static;






    /**
     * @param bool $status
     * @return $this
    */
    public function withPreExecutionStatus(bool $status): static;







    /**
     * Determine if log query before execution
     *
     * @return bool
    */
    public function isPreExecution(): bool;







    /**
     * @return bool
    */
    public function isLoggable(): bool;
}
