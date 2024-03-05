<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query;

use Laventure\Component\Database\Connection\Extensions\PDO\Query\Result\QueryResult;
use Laventure\Component\Database\Query\Exception\QueryException;
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
    protected array $parameters = [];





    /**
     * @var array
    */
    protected array $cache = [];




    /**
     * @var array
    */
    protected array $log = [
        'sql'          => '',
        'bindParams'   => [],
        'bindValues'   => [],
        'bindColumns'  => [],
        'params'       => []
    ];



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
        #dd($sql);
        $this->statement = $this->pdo->prepare($sql);

        return $this->log(compact('sql'));
    }




    /**
     * @inheritDoc
    */
    public function query(string $sql): static
    {
        $this->statement = $this->pdo->query($sql);

        return $this->log(compact('sql'));
    }




    /**
     * @inheritDoc
    */
    public function bindParam($param, $value, int $type = 0): static
    {
        $this->statement->bindParam($param, $value, $type);

        $this->log['bindParam'][] = compact('param', 'value', 'type');

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function bindValue($param, $value, int $type = 0): static
    {
        $this->statement->bindValue($param, $value, $type);

        $this->log['bindValue'][] = compact('param', 'value', 'type');

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

        $this->log['bindParam'][] = compact('column', 'value', 'type');

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function setParameters(array $parameters): static
    {
        $this->parameters = array_merge($this->parameters, $parameters);

        return $this->log(compact('parameters'));
    }





    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {
        $this->parameters[$id] = $value;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getParameter($id): mixed
    {
        return $this->parameters[$id] ?? null;
    }





    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }





    /**
     * @inheritDoc
     */
    public function execute(): bool
    {
        try {
            return $this->statement->execute($this->parameters);
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
            dd($e->getMessage());
            $this->abort($e);
        }
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
     * @inheritDoc
    */
    public function lastInsertId(string $name = null): int
    {
        return intval($this->pdo->lastInsertId($name));
    }






    /**
     * @param array $log
     * @return $this
    */
    private function log(array $log): static
    {
        $this->log = array_merge($this->log, $log);

        return $this;
    }






    /**
     * @param Throwable $e
     * @return void
     * @throws QueryException
    */
    private function abort(Throwable $e): void
    {
        throw new QueryException(
            "SQL: {$this->log['sql']} {$e->getMessage()}",
            $this->log,
            409
        );
    }
}
