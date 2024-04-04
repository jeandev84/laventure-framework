<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query;

use Laventure\Component\Database\Connection\Extensions\PDO\Query\Result\QueryResult;
use Laventure\Component\Database\Query\Exception\QueryException;
use Laventure\Component\Database\Query\Logger\DTO\Contract\ExecutedQueryInterface;
use Laventure\Component\Database\Query\Logger\DTO\ExecutedQuery;
use Laventure\Component\Database\Query\Logger\DTO\FailedQuery;
use Laventure\Component\Database\Query\Logger\QueryLoggerInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Query\Result\QueryResultInterface;
use PDO;
use PDOException;
use PDOStatement;
use Throwable;

/**
 * Statement
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Statement
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
     * @var QueryLoggerInterface
    */
    protected QueryLoggerInterface $logger;




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
    protected array $bindParams = [];




    /**
     * @var array
    */
    protected array $bindValues = [];





    /**
     * @var array
    */
    protected array $bindColumns = [];





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
     * @param QueryLoggerInterface $logger
    */
    public function __construct(PDO $pdo, QueryLoggerInterface $logger)
    {
        $this->pdo       = $pdo;
        $this->logger    = $logger;
        $this->statement = new PDOStatement();
    }




    /**
     * @inheritDoc
    */
    public function prepare(string $sql): static
    {
        $this->statement = $this->pdo->prepare($sql);

        return $this->logQuery($sql);
    }




    /**
     * @inheritDoc
    */
    public function query(string $sql): static
    {
        $this->statement = $this->pdo->query($sql);

        return $this->logQuery($sql);
    }




    /**
     * @inheritDoc
    */
    public function bindParam($param, $value, int $type = 0): static
    {
        $this->statement->bindParam($param, $value, $type);

        $this->bindParams[$param] = compact('param', 'value', 'type');

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function bindValue($param, $value, int $type = 0): static
    {
        $this->statement->bindValue($param, $value, $type);

        $this->bindValues[$param] = compact('param', 'value', 'type');

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

        $this->bindColumns[$column] = compact('column', 'value', 'type');

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function setParameters(array $parameters): static
    {
        $this->parameters = array_merge($this->parameters, $parameters);

        return $this;
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
            return $this->executeQueryWithParams();
        } catch (PDOException $e) {
            dump($e->getMessage(), __METHOD__);
            $this->abort($e);
        }

        return false;
    }







    /**
     * @inheritDoc
    */
    public function executeQuery(string $sql): int|false
    {
        $this->logger->logCurrentQuery($sql);

        try {

            $status = $this->pdo->exec($sql);

            if ($status !== false) {
                $this->logExecutedQuery($sql);
            }

            return $status;

        } catch (PDOException $e) {
            $this->abort($e);
        }

        return false;
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
     * @param string $query
     * @return $this
    */
    public function logQuery(string $query): static
    {
        $this->logger->logCurrentQuery($query);

        return $this;
    }






    /**
     * @return $this
    */
    public function logExecutedQuery(string $query): static
    {
        $this->logger->logExecutedQuery(
            $this->createExecutedQuery($query)
        );

        return $this;
    }






    /**
     * @param Throwable $e
     * @return $this
    */
    public function logFailedQuery(Throwable $e): static
    {
        $this->logger->logFailedQuery(
            new FailedQuery($this->logger->getCurrentQuery(), $e, [
                'context' => $this
            ])
        );

        return $this;
    }









    /**
     * @inheritDoc
    */
    public function setLogger(QueryLoggerInterface $logger): static
    {
        $this->logger = $logger;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getLogger(): QueryLoggerInterface
    {
        return $this->logger;
    }






    /**
     * @param string $sql
     * @return ExecutedQueryInterface
    */
    public function createExecutedQuery(string $sql): ExecutedQueryInterface
    {
        $query = new ExecutedQuery($sql);
        $query->parameters($this->parameters)
              ->bindParams($this->bindParams)
              ->bindValues($this->bindValues)
              ->bindColumns($this->bindColumns);

        return $query;
    }






    /**
     * @param Throwable $e
     * @return void
     */
    private function abort(Throwable $e): void
    {
        $message = sprintf(
            'SQL: %s | Message: %s',
            $this->logger->getCurrentQuery(),
            $e->getMessage()
        );

        $e = new QueryException($message, [
            'context' => $this,
            'code'    => $e->getCode()
        ], 500);

        $this->logFailedQuery($e);
    }





    /**
     * @return bool
    */
    private function executeQueryWithParams(): bool
    {
        if($status = $this->statement->execute($this->parameters)) {
            $this->logExecutedQuery($this->statement->queryString);
        }

        return $status;
    }
}
