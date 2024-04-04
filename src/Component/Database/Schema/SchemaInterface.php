<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema;

use Closure;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * SchemaInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema
 */
interface SchemaInterface
{
    /**
     * Create schema
     *
     * @param string $table
     *
     * @param Closure $closure
     *
     * @return mixed
    */
    public function create(string $table, Closure $closure): mixed;






    /**
     * PgsqlUpdateBuilder schema
     *
     * @param string $table
     *
     * @param Closure $closure
     *
     * @return mixed
     */
    public function update(string $table, Closure $closure): mixed;






    /**
     * Drop table
     *
     * @param string $table
     *
     * @return mixed
    */
    public function drop(string $table): mixed;








    /**
     * Truncate table
     *
     * @param string $table
     *
     * @return mixed
    */
    public function truncate(string $table): mixed;









    /**
     * Returns table columns
     *
     * @param string $table
     *
     * @return array
    */
    public function getColumns(string $table): array;







    /**
     * Determine if schema exists
     *
     * @param string $table
     *
     * @return bool
    */
    public function exists(string $table): bool;










    /**
     * Execute SQL
     *
     * @param string $sql
     * @return bool|int
    */
    public function exec(string $sql): mixed;









    /**
     * Create statement
     *
     * @param string $sql
     * @return QueryInterface
    */
    public function statement(string $sql): QueryInterface;









    /**
     * Return database tables
     *
     * @return array
    */
    public function getTables(): array;







    /**
     * Returns schema name by default
     *
     * @return string
    */
    public function getName(): string;







    /**
     * Returns connection
     *
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;








    /**
     * Returns instance of table
     *
     * @param string $name
     * @return TableInterface
    */
    public function table(string $name): TableInterface;










    /**
     * Dump schema
     *
     * @return mixed
    */
    public function dump(): mixed;
}
