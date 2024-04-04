<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Query;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;

/**
 * QueryBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Statement
 */
interface Builder
{
    /**
     * @return string
    */
    public function getClassName(): string;




    /**
     * @return string
    */
    public function getTableName(): string;




    /**
     * @return string
    */
    public function getPrimaryKey(): string;







    /**
     * @return ExpressionBuilderInterface
    */
    public function expr(): ExpressionBuilderInterface;





    /**
     * @param string ...$columns
     * @return $this
    */
    public function select(string ...$columns): static;





    /**
     * @return $this
    */
    public function distinct(): static;





    /**
     * @param string $from
     * @param string $alias
     * @return $this
    */
    public function from(string $from, string $alias = ''): static;







    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function join(string $table, string $condition): static;








    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function leftJoin(string $table, string $condition): static;








    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function rightJoin(string $table, string $condition): static;









    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function innerJoin(string $table, string $condition): static;










    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function fullJoin(string $table, string $condition): static;






    /**
     * @param string $column
     *
     * @param string|null $direction
     *
     * @return $this
    */
    public function orderBy(string $column, string $direction = null): static;






    /**
     * @param string $column
     *
     * @return $this
    */
    public function groupBy(string $column): static;








    /**
     * @param string $condition
     *
     * @return $this
    */
    public function having(string $condition): static;







    /**
     * @param int $limit
     *
     * @return $this
    */
    public function limit(int $limit): static;









    /**
     * @param int $offset
     *
     * @return $this
    */
    public function offset(int $offset): static;







    /**
     * @param string $condition
     * @return static
    */
    public function where(string $condition): static;






    /**
     * @param string $condition
     * @return $this
    */
    public function andWhere(string $condition): static;





    /**
     * @param string $condition
     * @return $this
    */
    public function orWhere(string $condition): static;





    /**
     * @param array $criteria
     * @return $this
    */
    public function criteria(array $criteria): static;






    /**
     * @param array $parameters
     * @return $this
    */
    public function params(array $parameters): static;






    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function param($id, $value): static;







    /**
     * Returns last inserted id
     *
     * @param array $attributes
     *
     * @return int
    */
    public function create(array $attributes): int;








    /**
     * @param array $attributes
     *
     * @return bool
    */
    public function update(array $attributes): bool;









    /**
     * @return bool
    */
    public function delete(): bool;









    /**
     * Fetch one result by criteria
     *
     * @return mixed
    */
    public function one(): mixed;






    /**
     * Fetch all result by criteria
     *
     * @return array
     */
    public function get(): array;






    /**
     * Fetch all result as array
     *
     * @return array
     */
    public function assoc(): array;







    /**
     * Fetch columns
     *
     * @return array
    */
    public function columns(): array;







    /**
     * Returns first result by criteria
     *
     * @return mixed
    */
    public function first(): mixed;






    /**
     * Returns count
     *
     * @return int
    */
    public function count(): int;





    /**
     * Returns sql
     *
     * @return string
    */
    public function getSQL(): string;





    /**
     * Returns parameters
     *
     * @return array
    */
    public function getParameters(): array;







    /**
     * Paginate query
     *
     * @param int $page
     * @param int $limit
     * @return array
    */
    public function paginate(int $page, int $limit): array;







    /**
     * @param $id
     * @return mixed
    */
    public function find($id): mixed;







    /**
     * Find all
     *
     * @return array
    */
    public function all(): array;
}
