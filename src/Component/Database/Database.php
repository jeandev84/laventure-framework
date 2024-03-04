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
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;


    /**
     * @var string
    */
    protected string $name;





    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection) {
        $this->connection = $connection;
        $this->name       = $connection->configuration()->database();
    }





    /**
     * @inheritDoc
    */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }




    /**
     * @inheritdoc
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
     * @return bool
    */
    public function exists(): bool
    {
        return in_array($this->getName(), $this->list());
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



    protected function createQuery(string $sql): bool|int
    {
        $config     = $this->connection->configuration();
        $database   = $config->database();
        $config->removeDatabase();
        $this->connection->connect($config);

    }
}
