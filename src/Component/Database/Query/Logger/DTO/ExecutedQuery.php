<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Logger\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use Laventure\Component\Database\Query\Logger\DTO\Contract\ExecutedQueryInterface;

/**
 * ExecutedQuery
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Logger\DTO
*/
class ExecutedQuery implements ExecutedQueryInterface
{
    /**
     * @param string $query
     * @param array $params
     * @param string $executedAt
    */
    public function __construct(
        protected string $query,
        protected array $params = [],
        protected string $executedAt = ''
    ) {
    }





    /**
     * @param array $params
     * @return $this
    */
    public function addParams(array $params): static
    {
        $this->params = array_merge(
            $this->params,
            $params
        );

        return $this;
    }







    /**
     * @param array $parameters
     * @return $this
    */
    public function parameters(array $parameters): static
    {
        return $this->addParams(compact('parameters'));
    }







    /**
     * @param array $bindingParams
     * @return $this
    */
    public function bindParams(array $bindingParams): static
    {
        return $this->addParams(compact('bindingParams'));
    }






    /**
     * @param array $bindValues
     * @return $this
    */
    public function bindValues(array $bindValues): static
    {
        return $this->addParams(compact('bindValues'));
    }






    /**
     * @param array $bindColumns
     * @return $this
    */
    public function bindColumns(array $bindColumns): static
    {
        return $this->addParams(compact('bindColumns'));
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
    public function getParams(): array
    {
        return $this->params;
    }






    /**
     * @inheritDoc
     * @throws Exception
    */
    public function getExecutedAt(): DateTimeInterface
    {
        return new DateTimeImmutable($this->executedAt);
    }
}
