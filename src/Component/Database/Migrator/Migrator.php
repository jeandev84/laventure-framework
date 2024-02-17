<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Migrator;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Migration\MigrationInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Schema;
use Laventure\Component\Database\Schema\SchemaInterface;

/**
 * Migrator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Migrator
*/
class Migrator implements MigratorInterface
{
    /**
     * Connection
     *
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;




    /**
     * Schema table
     *
     * @var Schema
    */
    protected Schema $schema;




    /**
     * Query builder
     *
     * @var QueryBuilderInterface
    */
    protected QueryBuilderInterface $builder;




    /**
     * Migration version table
     *
     * @var string
    */
    protected string $table;




    /**
     * Collect migrations
     *
     * @var MigrationInterface[]
    */
    protected array $migrations = [];




    /**
     * @var array
    */
    protected array $log = [];





    /**
     * @param ConnectionInterface $connection
     *
     * @param string $table
    */
    public function __construct(ConnectionInterface $connection, string $table = 'migrations')
    {
        $this->connection = $connection;
        $this->table      = $table;
        $this->builder    = $connection->createQueryBuilder();
        $this->schema     = new Schema($connection);
    }






    /**
     * @param MigrationInterface $migration
     * @return $this
    */
    public function addMigration(MigrationInterface $migration): static
    {
        $this->migrations[$migration->getVersion()] = $migration;

        return $this;
    }






    /**
     * @param MigrationInterface[] $migrations
     *
     * @return $this
    */
    public function addMigrations(array $migrations): static
    {
        foreach ($migrations as $migration) {
            $this->addMigration($migration);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function install(): bool
    {
        $func = function (Blueprint $table) {
            $table->id();
            $table->string('version');
            $table->datetime('executed_at');
        };

        return $this->schema->create($this->table, $func);
    }







    /**
     * @inheritDoc
    */
    public function migrate(): bool
    {
        $this->install();

        foreach ($this->getNewMigrations() as $migration) {
            $migration->up($this->schema);
            $this->builder->insert($this->table, [
                'version'     => $migration->getVersion(),
                'executed_at' => date('Y-m-d H:i:s')
            ])->getQuery()->execute();
        }

        return empty($this->getNewMigrations());
    }





    /**
     * @inheritDoc
    */
    public function rollback(): mixed
    {
        foreach ($this->getMigrations() as $migration) {
            $migration->down($this->schema);
        }

        return $this->schema->truncate($this->table);
    }







    /**
     * @inheritDoc
    */
    public function reset(): mixed
    {
        $this->rollback();

        return $this->schema->drop($this->table);
    }





    /**
     * @inheritDoc
    */
    public function refresh(): mixed
    {
        $this->reset();

        return $this->migrate();
    }




    /**
     * @inheritDoc
    */
    public function getMigrations(): array
    {
        return $this->migrations;
    }






    /**
     * @param string $name
     * @return bool
    */
    public function hasVersion(string $name): bool
    {
        return in_array($name, $this->getOldMigrations());
    }




    /**
     * @inheritDoc
    */
    public function getNewMigrations(): array
    {
        $func = function (MigrationInterface $migration) {
            return !$this->hasVersion($migration->getVersion());
        };

        return array_filter($this->getMigrations(), $func);
    }




    /**
     * @inheritDoc
    */
    public function getOldMigrations(): array
    {
        if (! $this->schema->exists($this->table)) {
            return [];
        }

        return $this->builder->select('version')
                             ->from($this->table)
                             ->getQuery()
                             ->fetch()
                             ->columns();
    }




    /**
     * @inheritDoc
    */
    public function getTable(): string
    {
        return $this->table;
    }





    /**
     * @return SchemaInterface
    */
    public function getSchema(): SchemaInterface
    {
        return $this->schema;
    }





    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }




    /**
     * Log process migration
     *
     * @param string $message
     *
     * @return void
    */
    public function log(string $message): void
    {
        $this->log[] = "[". date('Y-m-d H:i:s') . "] $message";
    }
}
