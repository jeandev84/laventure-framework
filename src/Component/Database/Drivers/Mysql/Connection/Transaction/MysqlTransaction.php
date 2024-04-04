<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql\Connection\Transaction;

use Laventure\Component\Database\Connection\Extensions\PDO\Transaction\Transaction;
use Laventure\Component\Database\Connection\Transaction\Contract\SwitchableTransactionInterface;

/**
 * MysqlTransaction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers\Mysql\Connection\Transaction
*/
class MysqlTransaction extends Transaction implements SwitchableTransactionInterface
{
    /**
     * @inheritDoc
    */
    public function enable(): static
    {
        return $this->autocommit(1);
    }




    /**
     * @inheritDoc
    */
    public function autocommit($value): static
    {
        $this->pdo->executeQuery("SET autocommit = $value");

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function disable(): static
    {
        return $this->autocommit(0);
    }
}
