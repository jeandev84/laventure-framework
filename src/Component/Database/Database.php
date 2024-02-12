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
 * @package  Laventure\Component\Database
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
}
