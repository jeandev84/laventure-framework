<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger;


use Laventure\Component\Database\Query\Logger\DTO\Contract\ExecutedQueryInterface;
use Laventure\Component\Database\Query\Logger\DTO\Contract\FailedQueryInterface;
use Throwable;

/**
 * QueryLoggerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Logger
 */
interface QueryLoggerInterface
{

    /**
     * Log current query
     *
     * @param string $query
     * @return mixed
    */
    public function logQuery(string $query): mixed;





    /**
     * @param ExecutedQueryInterface $query
     * @return mixed
    */
    public function logExecutedQuery(ExecutedQueryInterface $query): mixed;







     /**
      * @param FailedQueryInterface $query
      * @return mixed
     */
     public function logFailedQuery(FailedQueryInterface $query): mixed;







     /**
      * @return ExecutedQueryInterface[]
     */
     public function getExecutedQueries(): array;







     /**
      * @return array
     */
     public function getFailedQueries(): array;







     /**
      * @return string
     */
     public function getCurrentQuery(): string;






     /**
      * @return bool
     */
     public function isLoggable(): bool;
}