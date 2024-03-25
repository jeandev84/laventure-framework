<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Migrator;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Migration\Collection\MigrationCollectionInterface;
use Laventure\Component\Database\Schema\Migration\MigrationInterface;
use Laventure\Component\Database\Schema\SchemaInterface;

/**
 * MigratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Migrator
*/
interface MigratorInterface extends MigrationCollectionInterface
{
    /**
     * Create a migration version table
     *
     * @return mixed
    */
    public function install(): mixed;





    /**
     * Determine if migration table installed
     *
     * @return bool
    */
    public function installed(): bool;






    /**
     * Migrate all Migrations
     *
     * @return mixed
    */
    public function migrate(): mixed;






    /**
     * Determine if all versions migrated
     *
     * @return bool
    */
    public function migrated(): bool;






    /**
     * Drop all schema tables
     *
     * @return mixed
    */
    public function rollback(): mixed;







    /**
     * Drop all schema tables and version table.
     *
     * @return mixed
    */
    public function reset(): mixed;







    /**
     * Determine if all tables removed
     *
     * @return bool
    */
    public function removed(): bool;




    /**
     * Refresh Migrations
     *
     * @return mixed
    */
    public function refresh(): mixed;





    /**
     * Determine if table
     *
     * @return bool
    */
    public function refreshed(): bool;








    /**
     * Get Migrations to apply
     *
     * @return MigrationInterface[]
    */
    public function getMigrationsToApply(): array;








    /**
     * Get applied Migrations
     *
     * @return string[]
    */
    public function getAppliedMigrations(): array;






    /**
     * Set migrator version table
     *
     * @param string $table
     * @return $this
    */
    public function table(string $table): static;





    /**
     * Returns version table
     *
     * @return string
    */
    public function getTable(): string;






    /**
     * @return mixed
    */
    public function getStatus(): mixed;






    /**
     * Returns the connection
     *
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;







    /**
     * Returns table schema
     *
     * @return SchemaInterface
    */
    public function getSchema(): SchemaInterface;
}
