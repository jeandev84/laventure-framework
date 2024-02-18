<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema;

use Closure;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Info\Info;
use Laventure\Component\Database\Schema\Table\Factory\TableFactory;
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
     * @var TableFactoryInterface
    */
    protected TableFactoryInterface $factory;




    /**
     * @var string|null
    */
    protected ?string $name;




    /**
     * @param ConnectionInterface $connection
     * @param string|null $name
    */
    public function __construct(ConnectionInterface $connection, string $name = null)
    {
        $this->connection = $connection;
        $this->name       = $name;
        $this->factory    = new TableFactory($connection);
    }




    /**
     * @inheritdoc
    */
    public function table(string $name): TableInterface
    {
        return $this->factory->createTable(
            $name,
            $this->getName()
        );
    }






    /**
     * @inheritDoc
    */
    public function create(string $table, Closure $closure): bool
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
    public function update(string $table, Closure $closure): bool
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

        return $this->table($table)->drop();
    }








    /**
     * @inheritDoc
    */
    public function dropIfExists(string $table): mixed
    {
        return $this->table($table)->dropIfExists();
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
    public function truncateCascade(string $table): mixed
    {
        if (!$this->exists($table)) {
            return false;
        }

        return $this->table($table)->truncateCascade();
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
    public function hasColumn(string $table, string $column): bool
    {
        return $this->table($table)->hasColumn($column);
    }





    /**
     * @inheritDoc
    */
    public function exec(string $sql): bool
    {
        return $this->connection->executeQuery($sql);
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
        if (!$this->name) {
            $this->name = $this->connection
                               ->getDatabaseName();
        }

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
     * @return TableFactoryInterface
    */
    public function getFactory(): TableFactoryInterface
    {
        return $this->factory;
    }





    /**
     * @return Info
    */
    public function getInfo(): Info
    {
        return new Info([
            'name'    => $this->getName(),
            'tables'  => $this->getTables()
        ]);
    }
}
