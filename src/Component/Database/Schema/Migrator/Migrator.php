<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Migrator;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Migration\MigrationInterface;
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
     * PdoConnection
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
     * Migration version table
     *
     * @var string
    */
    protected string $table = 'migrations';




    /**
     * Reference column of version table
     *
     * @var string
    */
    protected string $referenceColumn = 'version';




    /**
     * @var string
    */
    protected string $executedColumn  = 'executed_at';




    /**
     * Collect Migrations
     *
     * @var MigrationInterface[]
    */
    protected array $migrations = [];





    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
        $this->schema     = new Schema($connection);
    }




    /**
     * @inheritDoc
    */
    public function table(string $table): static
    {
        $this->table = $table;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function addMigration(MigrationInterface $migration): static
    {
        $this->migrations[$migration->getName()] = $migration;

        return $this;
    }






    /**
     * @inheritDoc
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
            $table->string($this->referenceColumn);
            $table->datetime($this->executedColumn);
        };

        return $this->schema->create($this->table, $func);
    }




    /**
     * @inheritDoc
    */
    public function installed(): bool
    {
        return $this->schema->exists($this->table);
    }








    /**
     * @return MigrationInterface[]
     * @inheritDoc
    */
    public function migrate(): bool
    {
        $this->install();

        foreach ($this->getMigrationsToApply() as $migration) {
            $this->up($migration);
        }

        return true;
    }






    /**
     * @inheritDoc
    */
    public function migrated(): bool
    {
        return empty($this->getMigrationsToApply());
    }








    /**
     * @inheritDoc
    */
    public function rollback(): mixed
    {
        $this->down();

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
    public function removed(): bool
    {

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
    public function refreshed(): bool
    {

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
    public function isApplied(string $name): bool
    {
        return in_array($name, $this->getAppliedMigrations());
    }






    /**
     * @inheritDoc
    */
    public function getMigrationsToApply(): array
    {
        $func = function (MigrationInterface $migration) {
            return !$this->isApplied($migration->getName());
        };

        return array_filter($this->getMigrations(), $func);
    }






    /**
     * @inheritDoc
    */
    public function getAppliedMigrations(): array
    {
        if (! $this->installed()) {
            return [];
        }

        return $this->connection
                    ->createQueryBuilder()
                    ->select($this->referenceColumn)
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
     * @inheritDoc
    */
    public function getSchema(): SchemaInterface
    {
        return $this->schema;
    }





    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }






    /**
     * Update version table information and create current table schema
     *
     * @param MigrationInterface $migration
     * @return bool
    */
    public function up(MigrationInterface $migration): bool
    {
        if (!$this->installed()) {
            return false;
        }

        $migration->up($this->schema);

        return $this->save($migration);
    }







    /**
     * Rollback information version table and drop current schema
     *
     * @return void
    */
    public function down(): void
    {
        foreach ($this->getMigrations() as $migration) {
            $migration->down($this->schema);
        }
    }





    /**
     * @param MigrationInterface $migration
     * @return bool
    */
    public function save(MigrationInterface $migration): bool
    {
        $qb = $this->connection->createQueryBuilder();

        return $qb->insert($this->table)
                  ->values([
                    'version'     => $migration->getName(),
                    'executed_at' => date('Y-m-d H:i:s')
                  ])
                  ->getQuery()
                  ->execute();
    }





    /**
     * @inheritDoc
    */
    public function getStatus(): mixed
    {
        return null;
    }
}
