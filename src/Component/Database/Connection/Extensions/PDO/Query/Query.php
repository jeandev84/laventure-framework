<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query;

use Laventure\Component\Database\Query\QueryException;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Query\Result\QueryResultInterface;
use PDO;
use PDOException;
use PDOStatement;
use Throwable;

/**
 * Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Query
*/
class Query implements QueryInterface
{
    /**
     * @var PDO
    */
    protected PDO $pdo;




    /**
     * @var PDOStatement
    */
    protected PDOStatement $statement;




    /**
     * @var string
    */
    protected string $classname;




    /**
     * @var array
    */
    protected array $bindings = [];




    /**
     * @var array
    */
    protected array $params = [];





    /**
     * @var array
    */
    protected array $cache = [];




    /**
     * @var array
    */
    protected array $types = [
        'integer' => PDO::PARAM_INT,
        'boolean' => PDO::PARAM_BOOL,
        'null'    => PDO::PARAM_NULL
    ];





    /**
     * @param PDO $pdo
    */
    public function __construct(PDO $pdo)
    {
        $this->pdo       = $pdo;
        $this->statement = new PDOStatement();
    }




    /**
     * @inheritDoc
    */
    public function prepare(string $sql): static
    {
        $this->statement = $this->pdo->prepare($sql);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function query(string $sql): static
    {
        $this->statement = $this->pdo->query($sql);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function bindParam($param, $value, int $type = 0): static
    {
        $this->statement->bindParam($param, $value, $type);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function bindValue($param, $value, int $type = 0): static
    {
        $this->statement->bindValue($param, $value, $type);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function bindParams(array $params): static
    {
        foreach ($params as $bind) {
            [$id, $value, $type] = $bind;
            $this->bindParam($id, $value, $type);
        }

        return $this;
    }






    /**
     * @inheritDoc
     */
    public function bindValues(array $values): static
    {
        foreach ($values as $bind) {
            [$id, $value, $type] = $bind;
            $this->bindValue($id, $value, $type);
        }

        return $this;
    }




    /**
     * @inheritdoc
     */
    public function bindColumns(array $columns): static
    {
        foreach ($columns as $bind) {
            [$id, $value, $type] = $bind;
            $this->bindColumn($id, $value, $type);
        }

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function bindColumn($column, $value, int $type = 0): static
    {
        $this->statement->bindColumn($column, $value, $type);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function setParameters(array $params): static
    {
        $this->params = $params;

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function execute(): bool
    {
        try {
            return $this->statement->execute($this->params);
        } catch (PDOException $e) {
            $this->abort($e);
        }
    }




    /**
     * @inheritDoc
     */
    public function exec(string $sql): int|false
    {
        try {
            return $this->pdo->exec($sql);
        } catch (PDOException $e) {
            $this->abort($e);
        }
    }





    /**
     * @inheritDoc
     */
    public function lastInsertId(string $name = null): int
    {
        return intval($this->pdo->lastInsertId($name));
    }





    /**
     * @inheritDoc
     */
    public function map(string $classname): static
    {
        $this->statement->setFetchMode(PDO::FETCH_CLASS, $classname);

        $this->classname = $classname;

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function fetch(): QueryResultInterface
    {
        $this->execute();

        return new QueryResult($this->statement);
    }





    /**
     * @inheritDoc
     */
    public function getSQL(): string
    {
        return $this->statement->queryString;
    }





    /**
     * @param Throwable $e
     * @return void
     * @throws QueryException
    */
    private function abort(Throwable $e): void
    {
        throw new QueryException($e->getMessage(), [], 409);
    }
}
