<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Transaction;

use Closure;

/**
 * TransactionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Transaction
 */
interface TransactionInterface
{
    /**
     * Begin a transaction query
     *
     * @return bool
    */
    public function beginTransaction(): bool;






    /**
     * @return bool
    */
    public function hasActiveTransaction(): bool;






    /**
     * Commit transaction
     *
     * @return bool
    */
    public function commit(): bool;





    /**
     * Rollback transaction
     *
     * @return bool
    */
    public function rollback(): bool;





    /**
     * Transaction
     *
     * @param callable $func
     *
     * @return mixed
    */
    public function transaction(callable $func): mixed;
}
