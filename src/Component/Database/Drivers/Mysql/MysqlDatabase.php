<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql;

use Laventure\Component\Database\Database;

/**
 * MysqlDatabase
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Mysql
*/
class MysqlDatabase extends Database
{
    /**
     * @inheritDoc
    */
    public function create(): bool
    {
        $this->exec(
       "CREATE DATABASE IF NOT EXISTS {$this->getName()}",
            "DEFAULT CHARACTER SET {$this->charset()}",
            "DEFAULT COLLATE {$this->collation()};"
        );

        $this->exec("SET default_storage_engine = {$this->engine()};");

        return $this->exists();
    }




    /**
     * @inheritDoc
    */
    public function drop(): bool
    {
        $this->exec("DROP DATABASE IF EXISTS {$this->getName()};");

        return !$this->exists();
    }




    /**
     * @inheritDoc
    */
    public function getTables(): array
    {
        return $this->connection
                    ->statement("SHOW FULL TABLES FROM {$this->getName()};")
                    ->fetch()
                    ->columns();
    }





    /**
     * @return string
    */
    public function engine(): string
    {
        return $this->config('engine', 'INNODB');
    }




    /**
     * @inheritDoc
    */
    public function createSchema(string $name): mixed
    {
        #return $this->exec('CREATE SCHEMA ....');
        return false;
    }
}
