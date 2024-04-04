<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Transaction;

use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnectionInterface;
use Laventure\Component\Database\Connection\Transaction\Contract\TransactionInterface;
use Laventure\Component\Database\Connection\Transaction\Exception\TransactionException;
use Throwable;

/**
 * Transaction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Transaction
*/
class Transaction implements TransactionInterface
{
    /**
     * @param PdoConnectionInterface $pdo
    */
    public function __construct(protected PdoConnectionInterface $pdo)
    {
    }




    /**
     * @inheritDoc
    */
    public function begin(): bool
    {
        return $this->pdo->getConnection()->beginTransaction();
    }




    /**
     * @inheritDoc
    */
    public function hasActive(): bool
    {
        return $this->pdo->getConnection()->inTransaction();
    }





    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        return $this->pdo->getConnection()->commit();
    }





    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
        return $this->pdo->getConnection()->rollBack();
    }







    /**
     * @inheritDoc
    */
    public function transact(callable $func): mixed
    {
        $this->begin();

        try {
            $func($this->pdo);
            return $this->commit();

        } catch (Throwable $e) {
            $this->rollback();
            throw new TransactionException($e->getMessage(), ['context' => $this->pdo], 500);
        }
    }
}
