<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli\Query;

use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Query\Result\QueryResultInterface;
use mysqli;

/**
 * Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\Mysqli\Query
*/
class Query implements QueryInterface
{
    /**
     * @var mysqli
    */
    protected mysqli $mysqli;


    /**
     * @param mysqli $mysqli
    */
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }




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
    public function bindParams(array $params): static
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
    public function bindValues(array $values): static
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
    public function bindColumns(array $columns): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function setParameters(array $params): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function execute(): mixed
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function exec(string $sql): mixed
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
        return new QueryResult();
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return '';
    }
}
