<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Transaction\Contract;

use Laventure\Component\Database\Query\QueryInterface;

/**
 * TransactionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Transaction\Contract
 */
interface TransactionInterface
{
    /**
     * Begin a transaction query
     *
     * @return bool
    */
    public function begin(): bool;







    /**
     * @return bool
    */
    public function hasActive(): bool;






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
     * @param callable $func
     * @return mixed
    */
    public function transact(callable $func): mixed;
}
