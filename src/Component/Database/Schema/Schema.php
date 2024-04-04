<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema;

use Closure;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Exception\SchemaException;
use Laventure\Component\Database\Schema\Table\Exception\TableExistsException;
use Laventure\Component\Database\Schema\Table\Exception\TableNotExistsException;
use Laventure\Component\Database\Schema\Table\Factory\TableFactoryInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * Schema
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema
*/
class Schema implements SchemaInterface
{
    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;





    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }




    /**
     * @inheritdoc
    */
    public function table(string $name): TableInterface
    {
        return $this->connection->table($name);
    }






    /**
     * @inheritDoc
    */
    public function create(string $table, Closure $closure): mixed
    {
        if ($this->exists($table)) {
            return false;
        }

        $blueprint = new Blueprint($this->table($table));

        call_user_func($closure, $blueprint);

        return $blueprint->create();
    }





    /**
     * @inheritDoc
    */
    public function update(string $table, Closure $closure): mixed
    {
        if (!$this->exists($table)) {
            return false;
        }

        $blueprint = new Blueprint($this->table($table));

        call_user_func($closure, $blueprint);

        return $blueprint->update();
    }






    /**
     * @inheritDoc
    */
    public function drop(string $table): mixed
    {
        if (!$this->exists($table)) {
            return false;
        }

        return $this->table($table)
                    ->drop();
    }







    /**
     * @inheritDoc
    */
    public function truncate(string $table): mixed
    {
        if (!$this->exists($table)) {
            return false;
        }

        return $this->table($table)->truncate();
    }






    /**
     * @inheritDoc
    */
    public function getColumns(string $table): array
    {
        return $this->table($table)->getColumns();
    }







    /**
     * @inheritDoc
    */
    public function exists(string $table): bool
    {
        return in_array($table, $this->getTables());
    }







    /**
     * @inheritDoc
    */
    public function exec(string $sql): bool
    {
        return $this->connection->exec($sql);
    }





    /**
     * @inheritDoc
    */
    public function statement(string $sql): QueryInterface
    {
        return $this->connection->statement($sql);
    }







    /**
     * @inheritDoc
    */
    public function dump(): static
    {
        foreach ($this->getTables() as $table) {
            $this->table($table)->dump();
        }

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getTables(): array
    {
        return $this->connection
                    ->getDatabase()
                    ->getTables();
    }





    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->connection
                    ->getConfiguration()
                    ->getSchemaName();
    }





    /**
     * @inheritdoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }
}
