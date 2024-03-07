<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Insert;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * Insert
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML
*/
class Insert implements InsertBuilderInterface
{

    /**
     * @inheritDoc
    */
    public function insert(string $table): static
    {

    }

    /**
     * @inheritDoc
     */
    public function values(array $values): static
    {
        // TODO: Implement values() method.
    }

    /**
     * @inheritDoc
     */
    public function hasMultiple(array $values): bool
    {
        // TODO: Implement hasMultiple() method.
    }

    /**
     * @inheritDoc
     */
    public function addInsert(array $attributes, int $position = 0): static
    {
        // TODO: Implement addInsert() method.
    }

    /**
     * @inheritDoc
     */
    public function addMultipleInsert(array $values): static
    {
        // TODO: Implement addMultipleInsert() method.
    }

    /**
     * @inheritDoc
     */
    public function setValue(string $column, $value, int $index = 0): static
    {
        // TODO: Implement setValue() method.
    }

    /**
     * @inheritDoc
     */
    public function getSQL(): string
    {
        // TODO: Implement getSQL() method.
    }

    /**
     * @inheritDoc
     */
    public function setParameters(array $parameters): static
    {
        // TODO: Implement setParameters() method.
    }

    /**
     * @inheritDoc
     */
    public function setParameter($id, $value): static
    {
        // TODO: Implement setParameter() method.
    }

    /**
     * @inheritDoc
     */
    public function getParameter($id): mixed
    {
        // TODO: Implement getParameter() method.
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        // TODO: Implement getParameters() method.
    }

    /**
     * @inheritDoc
     */
    public function bindParam($id, $value, int $type = 0): static
    {
        // TODO: Implement bindParam() method.
    }

    /**
     * @inheritDoc
     */
    public function bindValue($id, $value, int $type = 0): static
    {
        // TODO: Implement bindValue() method.
    }

    /**
     * @inheritDoc
     */
    public function bindColumn($id, $value, int $type = 0): static
    {
        // TODO: Implement bindColumn() method.
    }

    /**
     * @inheritDoc
     */
    public function getConnection(): ConnectionInterface
    {
        // TODO: Implement getConnection() method.
    }

    /**
     * @inheritDoc
     */
    public function getQuery(): QueryInterface
    {
        // TODO: Implement getQuery() method.
    }

    /**
     * @inheritDoc
     */
    public function expr(): ExpressionBuilderInterface
    {
        // TODO: Implement expr() method.
    }

    /**
     * @inheritDoc
     */
    public function getCriteria(): CriteriaInterface
    {
        // TODO: Implement getCriteria() method.
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
    }
}