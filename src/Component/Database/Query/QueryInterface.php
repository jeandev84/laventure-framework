<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query;

use Laventure\Component\Database\Query\Logger\QueryLoggerInterface;
use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * QueryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement
*/
interface QueryInterface
{
    /**
     * Prepare query
     *
     * @param string $sql
     * @return $this
    */
    public function prepare(string $sql): static;




    /**
     * Create no prepared query
     *
     * @param string $sql
     * @return $this
    */
    public function query(string $sql): static;






    /**
     * @param $param
     * @param $value
     * @param int $type
     * @return $this
    */
    public function bindParam($param, $value, int $type = 0): static;






    /**
     * @param array $params
     * @return $this
    */
    public function bindParams(array $params): static;






    /**
     * @param $param
     * @param $value
     * @param int $type
     * @return $this
    */
    public function bindValue($param, $value, int $type = 0): static;






    /**
     * @param array $values
     * @return $this
    */
    public function bindValues(array $values): static;





    /**
     * @param $column
     * @param $value
     * @param int $type
     * @return $this
     */
    public function bindColumn($column, $value, int $type = 0): static;






    /**
     * @param array $columns
     * @return $this
    */
    public function bindColumns(array $columns): static;





    /**
     * Set query main
     *
     * @param array $parameters
     * @return $this
    */
    public function setParameters(array $parameters): static;






    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function setParameter($id, $value): static;





    /**
     * Returns parameter value
     *
     * @param $id
     * @return mixed
    */
    public function getParameter($id): mixed;








    /**
     * Returns parameters
     *
     * @return array
    */
    public function getParameters(): array;







    /**
     * Execute query
     *
     * @return bool
    */
    public function execute(): bool;






    /**
     * Execute simple query
     *
     * @param string $sql
     * @return int|false
    */
    public function executeQuery(string $sql): int|false;







    /**
     * Returns last insert ID
     *
     * @param string|null $name
     *
     * @return int
    */
    public function lastInsertId(string $name = null): int;





    /**
     * Save the class name to fetch
     *
     * @param string $classname
     *
     * @return $this
    */
    public function map(string $classname): static;







    /**
     * Fetch result by mode
     *
     * @return QueryResultInterface
    */
    public function fetch(): QueryResultInterface;








    /**
     * Returns query string
     *
     * @return string
    */
    public function getSQL(): string;







    /**
     * @param QueryLoggerInterface $logger
     * @return $this
    */
    public function setLogger(QueryLoggerInterface $logger): static;






    /**
     * @return QueryLoggerInterface
    */
    public function getLogger(): QueryLoggerInterface;
}
