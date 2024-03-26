<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger;

use Laventure\Component\Database\Query\Logger\DTO\Contract\ExecutedQueryInterface;
use Laventure\Component\Database\Query\Logger\DTO\Contract\FailedQueryInterface;

/**
 * QueryLogger
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Logger
 */
class QueryLogger implements QueryLoggerInterface
{

    /**
     * @var string
    */
    protected string $query;




    /**
     * @var bool
    */
    protected bool $loggable = true;




    /**
     * @var ExecutedQueryInterface[]
    */
    protected array $executedQueries = [];




    /**
     * @var FailedQueryInterface[]
    */
    protected array $failedQueries = [];





    /**
     * @param string $query
    */
    public function __construct(string $query = '')
    {
         $this->logQuery($query);
    }






    /**
     * @param bool $loggable
     * @return $this
    */
    public function loggable(bool $loggable): static
    {
        $this->loggable = $loggable;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function logQuery(string $query): static
    {
       $this->query = $query;

       return $this;
    }





    /**
     * @inheritDoc
    */
    public function logExecutedQuery(ExecutedQueryInterface $query): static
    {
        if ($this->isLoggable()) {
            $this->executedQueries[] = $query;
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function logFailedQuery(FailedQueryInterface $query): static
    {
        if (!$this->isLoggable()) {
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
    public function isLoggable(): bool
    {
        return $this->loggable;
    }
}