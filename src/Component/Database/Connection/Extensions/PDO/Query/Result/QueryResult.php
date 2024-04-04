<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Result;

use Laventure\Component\Database\Query\Result\QueryResultInterface;
use PDO;
use PDOStatement;

/**
 * QueryResult
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Statement
 */
class QueryResult implements QueryResultInterface
{
    /**
     * @var PDOStatement
    */
    protected PDOStatement $statement;




    /**
     * @param PDOStatement $statement
    */
    public function __construct(PDOStatement $statement)
    {
        $this->statement = $statement;
    }




    /**
     * @inheritDoc
    */
    public function all(int $fetchMode = 0): array
    {
        return $this->statement->fetchAll($fetchMode);
    }






    /**
     * @inheritDoc
    */
    public function first(): mixed
    {
        return $this->all()[0] ?? null;
    }






    /**
     * @inheritDoc
    */
    public function one(int $fetchMode = 0): mixed
    {
        return $this->statement->fetch($fetchMode);
    }




    /**
     * @inheritDoc
    */
    public function assoc(): array
    {
        return $this->all(PDO::FETCH_ASSOC);
    }




    /**
     * @inheritDoc
    */
    public function column(int $column = 0): mixed
    {
        return $this->statement->fetchColumn($column);
    }





    /**
     * @inheritDoc
    */
    public function columns(): array
    {
        return $this->all(PDO::FETCH_COLUMN);
    }





    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return $this->statement->rowCount();
    }
}
