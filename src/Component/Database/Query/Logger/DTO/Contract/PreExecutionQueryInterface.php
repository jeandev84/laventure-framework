<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger\DTO\Contract;

use Laventure\Component\Database\Query\QueryInterface;

/**
 * PreExecutionQueryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Logger\DTO\Contract
 */
interface PreExecutionQueryInterface
{
    /**
     * @return string
    */
    public function getSQL(): string;




    /**
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface;
}
