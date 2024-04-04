<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use Laventure\Component\Database\Query\Logger\DTO\Contract\FailedQueryInterface;
use Throwable;

/**
 * FailedQuery
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Logger\DTO
 */
class FailedQuery implements FailedQueryInterface
{
    /**
     * @param string $query
     * @param Throwable $error
     * @param array $options
    */
    public function __construct(
        protected string $query,
        protected Throwable $error,
        protected array $options = []
    ) {
    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->query;
    }



    /**
     * @inheritDoc
    */
    public function getError(): Throwable
    {
        return $this->error;
    }




    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->options;
    }





    /**
     * @inheritDoc
    */
    public function getFailedAt(): DateTimeInterface
    {
        return new DateTimeImmutable();
    }
}
