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
     * @param MigrationInterface $migration
     * @return $this
    */
    public function addMigration(MigrationInterface $migration): static
    {
        $this->migrations[$migration->getName()] = $migration;

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
    public function installed(): bool
    {
        return $this->schema->exists($this->table);
    }








    /**
     * @inheritDoc
    */
    public function migrate(): bool
    {
        $this->install();

        foreach ($this->getNewMigrations() as $migration) {
            $this->up($migration);
        }

        return $this->migrated();
    }






    /**
     * @inheritDoc
    */
    public function migrated(): bool
    {
        return empty($this->getNewMigrations());
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
    public function isOldMigration(string $name): bool
    {
        return in_array($name, $this->getOldMigrations());
    }






    /**
     * @inheritDoc
    */
    public function getNewMigrations(): array
    {
        $func = function (MigrationInterface $migration) {
            return !$this->isOldMigration($migration->getName());
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

        $qb = $this->connection->createQueryBuilder();

        return $qb->select('version')
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
}
