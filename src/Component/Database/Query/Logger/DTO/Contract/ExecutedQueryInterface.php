<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger\DTO\Contract;

use DateTimeInterface;

/**
 * ExecutedQueryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Logger
 */
interface ExecutedQueryInterface
{
    /**
     * @return string
    */
    public function getSQL(): string;




    /**
     * @return array
    */
    public function getParams(): array;






    /**
     * @return DateTimeInterface
    */
    public function getExecutedAt(): DateTimeInterface;
}
