<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Migrator;

use Laventure\Component\Database\Migration\Migration;
use Laventure\Component\Database\Migration\MigrationInterface;

/**
 * MigratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Migrator
*/
interface MigratorInterface
{
    /**
     * Create a migration version table
     *
     * @return mixed
    */
    public function install(): mixed;







    /**
     * Migrate all migrations
     *
     * @return mixed
    */
    public function migrate(): mixed;







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
     * Refresh migrations
     *
     * @return mixed
    */
    public function refresh(): mixed;







    /**
     * Get all migrations
     *
     * @return MigrationInterface[]
    */
    public function getMigrations(): array;







    /**
     * Get migrations to apply
     *
     * @return MigrationInterface[]
    */
    public function getNewMigrations(): array;








    /**
     * Get applied migrations
     *
     * @return string[]
    */
    public function getOldMigrations(): array;






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
}
