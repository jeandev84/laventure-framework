<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL;


use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;


/**
 * Builder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL
*/
abstract class Builder implements SQLBuilderInterface
{

    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {

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

    }




    /**
     * @inheritDoc
    */
    public function bindValue($id, $value, int $type = 0): static
    {

    }




    /**
     * @inheritDoc
    */
    public function bindColumn($id, $value, int $type = 0): static
    {

    }




    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function getCriteria(): CriteriaInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function __toString()
    {

    }
}