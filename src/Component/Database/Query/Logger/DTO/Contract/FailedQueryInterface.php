<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger\DTO\Contract;

use DateTimeInterface;
use Throwable;

/**
 * FailedQueryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Logger\DTO
 */
interface FailedQueryInterface
{
    /**
     * @return string
    */
    public function getSQL(): string;





    /**
     * @return Throwable
    */
    public function getError(): Throwable;






    /**
     * @return DateTimeInterface
    */
    public function getFailedAt(): DateTimeInterface;






    /**
     * @return array
    */
    public function getOptions(): array;
}
