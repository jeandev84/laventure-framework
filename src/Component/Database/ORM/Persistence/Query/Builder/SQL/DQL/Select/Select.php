<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DQL\Select;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\EntityManagerInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * Select
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DQL
*/
class Select implements SelectBuilderInterface
{

    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(
        protected EntityManagerInterface $em
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function criteria(array $conditions): static
    {

    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {

    }





    /**
     * @return string
    */
    public function getMappedClass(): string
    {
        return '';
    }





    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {

    }




    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {

    }




    /**
     * @inheritDoc
    */
    public function getParameter($id): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {

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
    public function select(string $columns): static
    {
        // TODO: Implement select() method.
    }

    /**
     * @inheritDoc
     */
    public function distinct(): static
    {
        // TODO: Implement distinct() method.
    }

    /**
     * @inheritDoc
     */
    public function addSelect(string $columns): static
    {
        // TODO: Implement addSelect() method.
    }

    /**
     * @inheritDoc
     */
    public function from(string $table, string $alias = ''): static
    {
        // TODO: Implement from() method.
    }

    /**
     * @inheritDoc
     */
    public function join(string $table, string $condition): static
    {
        // TODO: Implement join() method.
    }

    /**
     * @inheritDoc
     */
    public function leftJoin(string $table, string $condition): static
    {
        // TODO: Implement leftJoin() method.
    }

    /**
     * @inheritDoc
     */
    public function rightJoin(string $table, string $condition): static
    {
        // TODO: Implement rightJoin() method.
    }

    /**
     * @inheritDoc
     */
    public function innerJoin(string $table, string $condition): static
    {
        // TODO: Implement innerJoin() method.
    }

    /**
     * @inheritDoc
     */
    public function fullJoin(string $table, string $condition): static
    {
        // TODO: Implement fullJoin() method.
    }

    /**
     * @inheritDoc
     */
    public function addJoin(string $join): static
    {
        // TODO: Implement addJoin() method.
    }

    /**
     * @inheritDoc
     */
    public function groupBy(string $columns): static
    {
        // TODO: Implement groupBy() method.
    }

    /**
     * @inheritDoc
     */
    public function addGroupBy(string $columns): static
    {
        // TODO: Implement addGroupBy() method.
    }

    /**
     * @inheritDoc
     */
    public function addHaving(string $condition, $type = null): static
    {
        // TODO: Implement addHaving() method.
    }

    /**
     * @inheritDoc
     */
    public function having(string $condition): static
    {
        // TODO: Implement having() method.
    }

    /**
     * @inheritDoc
     */
    public function andHaving(string $condition): static
    {
        // TODO: Implement andHaving() method.
    }

    /**
     * @inheritDoc
     */
    public function orHaving(string $condition): static
    {
        // TODO: Implement orHaving() method.
    }

    /**
     * @inheritDoc
     */
    public function orderBy(string $column, string $direction = null): static
    {
        // TODO: Implement orderBy() method.
    }

    /**
     * @inheritDoc
     */
    public function addOrderBy(array $orders): static
    {
        // TODO: Implement addOrderBy() method.
    }

    /**
     * @inheritDoc
     */
    public function limit($limit): static
    {
        // TODO: Implement limit() method.
    }

    /**
     * @inheritDoc
     */
    public function offset($offset): static
    {
        // TODO: Implement offset() method.
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
    }

    /**
     * @inheritDoc
     */
    public function where($condition): static
    {
        // TODO: Implement where() method.
    }

    /**
     * @inheritDoc
     */
    public function whereIn($column, array $value): static
    {
        // TODO: Implement whereIn() method.
    }

    /**
     * @inheritDoc
     */
    public function whereEqualTo($column, $value): static
    {
        // TODO: Implement whereEqualTo() method.
    }

    /**
     * @inheritDoc
     */
    public function andWhere($condition): static
    {
        // TODO: Implement andWhere() method.
    }

    /**
     * @inheritDoc
     */
    public function orWhere($condition): static
    {
        // TODO: Implement orWhere() method.
    }

    /**
     * @inheritDoc
     */
    public function addWhere($condition, $type = null): static
    {
        // TODO: Implement addWhere() method.
    }

    /**
     * @inheritDoc
     */
    public function getWheres(): array
    {
        // TODO: Implement getWheres() method.
    }
}