<?php

declare(strict_types=1);

namespace Laventure\Component\Database;

use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * Database
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Driver
 */
abstract class Database implements DatabaseInterface
{
    /**
     * @param ConnectionInterface $connection
     * @param string $name
    */
    public function __construct(
        protected ConnectionInterface $connection,
        protected string $name
    ) {

    }




    /**
     * @inheritdoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }





    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }




    /**
     * @return bool
    */
    public function exists(): bool
    {
        return in_array($this->name, $this->list());
    }




    /**
     * @param array $queries
     * @return void
    */
    public function executeQueries(array $queries): void
    {
        foreach ($queries as $query) {
            $this->connection->executeQuery($query);
        }
    }




    /**
     * @param $key
     * @param $default
     * @return mixed
    */
    public function config($key, $default = null): mixed
    {
        return $this->connection->config($key, $default);
    }





    /**
     * @return string
    */
    public function charset(): string
    {
        return $this->config('charset', 'utf8');
    }






    /**
     * @return string
    */
    public function collation(): string
    {
        return $this->config('collation', 'utf8_general_ci');
    }





    /**
     * @param string $sql
     * @return bool|int
    */
    public function exec(string $sql): bool|int
    {
        return $this->connection->executeQuery($sql);
    }
}
