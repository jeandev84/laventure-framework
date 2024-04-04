<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Null;

use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Query\Result\Null\NullQueryResult;
use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * NullQuery
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement
*/
class NullQuery implements QueryInterface
{
    /**
     * @inheritDoc
     */
    public function prepare(string $sql): static
    {
        return $this;
    }




    /**
     * @inheritDoc
     */
    public function query(string $sql): static
    {
        return $this;
    }




    /**
     * @inheritDoc
     */
    public function bindParam($param, $value, int $type = 0): static
    {
        return $this;
    }




    /**
     * @inheritDoc
     */
    public function bindValue($param, $value, int $type = 0): static
    {
        return $this;
    }




    /**
     * @inheritDoc
     */
    public function bindColumn($column, $value, int $type = 0): static
    {
        return $this;
    }




    /**
     * @inheritDoc
     */
    public function bindParams(array $params): static
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bindValues(array $values): static
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bindColumns(array $columns): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getParameter($id): mixed
    {
        return null;
    }




    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
        return [];
    }





    /**
     * @inheritDoc
     */
    public function execute(): bool
    {
        return false;
    }





    /**
     * @inheritDoc
     */
    public function executeQuery(string $sql): bool
    {
        return false;
    }





    /**
     * @inheritDoc
     */
    public function lastInsertId(string $name = null): int
    {
        return 0;
    }




    /**
     * @inheritDoc
     */
    public function map(string $classname): static
    {
        return $this;
    }





    /**
     * @inheritDoc
     */
    public function fetch(): QueryResultInterface
    {
        return new NullQueryResult();
    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return '';
    }
}
