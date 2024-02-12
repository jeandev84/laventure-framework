<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Transaction;

/**
 * TransactionFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Transaction
*/
interface TransactionFactoryInterface
{
    /**
     * Create a transaction instance
     *
     * @return TransactionInterface
    */
    public function createTransaction(): TransactionInterface;
}
