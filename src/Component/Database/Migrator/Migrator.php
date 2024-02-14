<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Migrator;

use Laventure\Component\Database\Builder\SqlQueryBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Migration\MigrationInterface;
use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Schema;

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
     * @var SqlQueryBuilder
    */
    protected SqlQueryBuilder $builder;




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
        $this->builder    = new SqlQueryBuilder($connection);
        $this->schema     = new Schema($connection);
    }




    /**
     * @param string $table
     * @return $this
    */
    public function table(string $table): static
    {
        $this->table = $table;

        return $this;
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
        return $this->schema->create($this->table, function (Blueprint $table) {
            $table->id();
            $table->string('version');
            $table->datetime('executed_at');
        });
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

        return true;
    }





    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
        foreach ($this->getMigrations() as $migration) {
            $migration->down($this->schema);
        }

        return $this->schema->truncate($this->table);
    }







    /**
     * @inheritDoc
    */
    public function reset(): bool
    {
        $this->rollback();

        return $this->schema->drop($this->table);
    }





    /**
     * @inheritDoc
    */
    public function refresh(): bool
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
     * @inheritDoc
    */
    public function getNewMigrations(): array
    {
        return array_filter($this->getMigrations(), function (MigrationInterface $migration) {
            return !in_array($migration->getVersion(), $this->getOldMigrations());
        });
    }




    /**
     * @inheritDoc
    */
    public function getOldMigrations(): array
    {
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
