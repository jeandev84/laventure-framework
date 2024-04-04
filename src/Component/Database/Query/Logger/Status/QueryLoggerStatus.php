<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger\Status;

/**
 * QueryLoggerStatus
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Logger
 */
class QueryLoggerStatus implements QueryLoggerStatusInterface
{
    /**
     * @param bool $loggable
     * @param bool $preExecutionStatus
    */
    public function __construct(
        protected bool $loggable = true,
        protected bool $preExecutionStatus = false
    ) {
    }




    /**
     * @inheritDoc
    */
    public function withLoggableStatus(bool $loggable): static
    {
        $this->loggable = $loggable;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function isLoggable(): bool
    {
        return $this->loggable;
    }





    /**
     * @inheritDoc
    */
    public function withPreExecutionStatus(bool $status): static
    {
        $this->preExecutionStatus = $status;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function isPreExecution(): bool
    {
        return $this->loggable && $this->preExecutionStatus;
    }
}
