<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Transaction\Contract;

/**
 * SwitchableTransactionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Transaction\Contract
 */
interface SwitchableTransactionInterface extends TransactionInterface
{
    /**
     * @return mixed
    */
    public function enable(): static;




    /**
     * @param $value
     * @return $this
    */
    public function autocommit($value): static;





    /**
     * @return $this
    */
    public function disable(): static;
}
