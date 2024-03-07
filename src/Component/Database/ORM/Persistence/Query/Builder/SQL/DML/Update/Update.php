<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Update;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\BuilderHasConditions;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\SQLBuilderHasConditionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * Update
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Update
*/
class Update extends BuilderHasConditions
{

      /**
        * @param EntityManagerInterface $em
        * @param string $table
        * @param array $attributes
       */
       public function ddd(
           EntityManagerInterface $em,
           string $table,
           array $attributes = []
       )
       {
       }




       /**
        * @param EntityManagerInterface $em
        * @param string $table
        * @param array $attributes
       */
       public function __construct(
           EntityManagerInterface $em,
           string $table,
           array $attributes
       )
       {
           parent::__construct($em, $builder);
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
    public function set($column, $value): static
    {
        // TODO: Implement set() method.
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
    public function update(string $table): static
    {
        // TODO: Implement update() method.
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