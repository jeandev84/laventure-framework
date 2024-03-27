<?php

declare(strict_types=1);

namespace Laventure\Component\Database;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Exception\DatabaseException;
use Laventure\Component\Database\Query\QueryInterface;

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
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;





    /**
     * @var string
    */
    protected string $name;




    /**
     * @param ConnectionInterface $connection
     * @param string $name
    */
    public function __construct(ConnectionInterface $connection, string $name)
    {
        $this->connection = $connection;
        $this->name       = $name;
    }





    /**
     * @inheritdoc
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }






    /**
     * @inheritdoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }





    /**
     * @inheritdoc
    */
    public function exists(): bool
    {
        return $this->connection
                    ->getDatabaseCollection()
                    ->has($this->getName());
    }






    /**
     * @inheritDoc
     * @param string $filepath
     * @return bool|int
    */
    public function dump(string $filepath): bool|int
    {
        return $this->exec(sprintf("BACKUP DATABASE %s TO DISK = '%s'", $this->getName(), $filepath));
    }





    /**
     * @inheritDoc
    */
    public function dumpDiff(string $filepath): bool|int
    {
        return $this->exec(sprintf("BACKUP DATABASE %s TO DISK = '%s' WITH DIFFERENTIAL", $this->getName(), $filepath));
    }





    /**
     * @param $key
     * @param $default
     * @return mixed
    */
    public function config($key, $default = null): mixed
    {
        return $this->connection->getConfiguration()->get($key, $default);
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
        return $this->connection
                    ->getConfiguration()
                    ->getCollation();
    }




    /**
     * @param string ...$sql
     * @return bool|int
    */
    public function exec(string ...$sql): bool|int
    {
        return $this->connection->executeQuery(join(' ', $sql));
    }





    /**
     * @param $sql
     * @return QueryInterface
    */
    public function statement($sql): QueryInterface
    {
        return $this->connection->statement($sql);
    }
}
