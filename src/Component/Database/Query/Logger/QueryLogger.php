<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger;

use Laventure\Component\Database\Query\Logger\DTO\Contract\ExecutedQueryInterface;
use Laventure\Component\Database\Query\Logger\DTO\Contract\FailedQueryInterface;
use Laventure\Component\Database\Query\Logger\DTO\Contract\PreExecutionQueryInterface;
use Laventure\Component\Database\Query\Logger\Status\QueryLoggerStatus;
use Laventure\Component\Database\Query\Logger\Status\QueryLoggerStatusInterface;

/**
 * QueryLogger
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Logger
 */
class QueryLogger implements QueryLoggerInterface
{
    /**
     * @var string
    */
    protected string $query;




    /**
     * @var QueryLoggerStatusInterface
    */
    protected QueryLoggerStatusInterface $status;




    /**
     * @var PreExecutionQueryInterface[]
    */
    protected array $preExecutionQueries = [];




    /**
     * @var ExecutedQueryInterface[]
    */
    protected array $executedQueries = [];




    /**
     * @var FailedQueryInterface[]
    */
    protected array $failedQueries = [];



    public function __construct()
    {
        $this->status = new QueryLoggerStatus();
    }






    /**
     * @param QueryLoggerStatusInterface $status
     * @return $this
    */
    public function setStatus(QueryLoggerStatusInterface $status): static
    {
        $this->status = $status;

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function logCurrentQuery(string $query): static
    {
        if ($this->getStatus()->isLoggable()) {
            $this->query = $query;
        }

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function logQueryPreExecution(PreExecutionQueryInterface $query): static
    {
        if ($this->getStatus()->isPreExecution()) {
            $this->preExecutionQueries[] = $query;
        }

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function logExecutedQuery(ExecutedQueryInterface $query): static
    {
        if ($this->getStatus()->isLoggable()) {
            $this->executedQueries[] = $query;
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function logFailedQuery(FailedQueryInterface $query): static
    {
        if (!$this->getStatus()->isLoggable()) {
            throw $query->getError();
        }

        $this->failedQueries[] = $query;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getExecutedQueries(): array
    {
        return $this->executedQueries;
    }





    /**
     * @inheritDoc
    */
    public function getFailedQueries(): array
    {
        return $this->failedQueries;
    }





    /**
     * @inheritDoc
    */
    public function getCurrentQuery(): string
    {
        return $this->query;
    }





    /**
     * @inheritDoc
    */
    public function getPreExecutionQueries(): array
    {
        return $this->preExecutionQueries;
    }





    /**
     * @inheritDoc
    */
    public function getStatus(): QueryLoggerStatusInterface
    {
        return $this->status;
    }
}
