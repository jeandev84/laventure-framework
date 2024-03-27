<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Transaction\Factory;

use Laventure\Component\Database\Connection\Transaction\Contract\TransactionInterface;

/**
 * TransactionFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Transaction
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
