<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Migration\Collection;

use Laventure\Component\Database\Schema\Migration\MigrationInterface;

/**
 * MigrationCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Migration\Collection
 */
interface MigrationCollectionInterface
{
    /**
     * Add migrations
     *
     * @param MigrationInterface[] $migrations
     *
     * @return $this
    */
    public function addMigrations(array $migrations): static;





    /**
     * Add migration
     *
     * @param MigrationInterface $migration
     * @return $this
    */
    public function addMigration(MigrationInterface $migration): static;







    /**
     * Get all Migrations
     *
     * @return MigrationInterface[]
    */
    public function getMigrations(): array;
}
