<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Mysql;

use Laventure\Component\Database\Database;

/**
 * MysqlDatabase
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Types\Mysql
*/
class MysqlDatabase extends Database
{
    /**
     * @inheritDoc
    */
    public function create(): bool
    {
        $this->exec("CREATE DATABASE IF NOT EXISTS {$this->getName()};");
        $this->exec("DEFAULT CHARACTER SET {$this->charset()};");
        $this->exec("DEFAULT COLLATE {$this->collation()};");
        $this->exec("SET default_storage_engine = {$this->engine()};");

        return $this->exists();
    }




    /**
     * @inheritDoc
    */
    public function drop(): bool
    {
        $this->exec("DROP DATABASE IF EXISTS {$this->name};");

        return !$this->exists();
    }




    /**
     * @inheritDoc
    */
    public function getTables(): array
    {
        return $this->connection
                    ->statement("SHOW FULL TABLES FROM {$this->name};")
                    ->fetch()
                    ->columns();
    }




    /**
     * @inheritDoc
    */
    public function list(): array
    {
        return $this->connection
                    ->statement("SHOW DATABASES;")
                    ->fetch()
                    ->columns();
    }





    /**
     * @return string
    */
    public function engine(): string
    {
        return $this->connection->config('engine', 'InnoDB');
    }




    /**
     * @inheritDoc
    */
    public function createSchema(string $name): mixed
    {
        #return $this->connection->executeQuery('CREATE SCHEMA ....');
        return false;
    }
}
