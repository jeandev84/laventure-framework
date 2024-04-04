<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger;

use Laventure\Component\Database\Query\Logger\DTO\Contract\ExecutedQueryInterface;
use Laventure\Component\Database\Query\Logger\DTO\Contract\FailedQueryInterface;
use Laventure\Component\Database\Query\Logger\DTO\Contract\PreExecutionQueryInterface;
use Laventure\Component\Database\Query\Logger\Status\QueryLoggerStatusInterface;
use Throwable;

/**
 * QueryLoggerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Logger
 */
interface QueryLoggerInterface
{
    /**
     * Log current query
     *
     * @param string $query
     * @return $this
    */
    public function logCurrentQuery(string $query): static;







    /**
     * Log query before execution
     *
     * @param PreExecutionQueryInterface $query
     * @return $this
    */
    public function logQueryPreExecution(PreExecutionQueryInterface $query): static;








    /**
     * @param ExecutedQueryInterface $query
     * @return $this
    */
    public function logExecutedQuery(ExecutedQueryInterface $query): static;







    /**
     * @param FailedQueryInterface $query
     * @return $this
    */
    public function logFailedQuery(FailedQueryInterface $query): static;







    /**
     * @return ExecutedQueryInterface[]
    */
    public function getExecutedQueries(): array;







    /**
     * @return array
    */
    public function getFailedQueries(): array;









    /**
     * @return array
    */
    public function getPreExecutionQueries(): array;







    /**
     * @return string
    */
    public function getCurrentQuery(): string;







    /**
     * @param QueryLoggerStatusInterface $status
     * @return $this
    */
    public function setStatus(QueryLoggerStatusInterface $status): static;







    /**
     * @return QueryLoggerStatusInterface
    */
    public function getStatus(): QueryLoggerStatusInterface;
}
