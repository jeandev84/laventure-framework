<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * MysqlInsertBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands
*/
class MysqlInsertBuilder implements InsertBuilderInterface
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

    }


    /**
     * @inheritDoc
    */
    public function hasMultiple(array $values): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function addInsert(array $attributes, int $index = 0): static
    {

    }




    /**
     * @inheritDoc
    */
    public function addMultipleInsert(array $values): static
    {

    }




    /**
     * @inheritDoc
    */
    public function setValue(string $column, $value, int $index = 0): static
    {

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