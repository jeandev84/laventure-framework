<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql;

use Laventure\Component\Database\Drivers\Database;

/**
 * MysqlDatabase
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers\Mysql
*/
class MysqlDatabase extends Database
{
    /**
     * @inheritDoc
    */
    public function create(): bool
    {
        $this->connection->executeQuery("CREATE DATABASE IF NOT EXISTS {$this->name};");
        $this->connection->executeQuery("DEFAULT CHARACTER SET {$this->charset()};");
        $this->connection->executeQuery("DEFAULT COLLATE {$this->collation()};");
        $this->connection->executeQuery("SET default_storage_engine {$this->collation()};");

        return $this->exists();
    }




    /**
     * @inheritDoc
    */
    public function drop(): bool
    {
        $this->connection->executeQuery("DROP DATABASE IF EXISTS {$this->name};");

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
}
