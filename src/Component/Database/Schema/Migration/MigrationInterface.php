<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Migration;

use Laventure\Component\Database\Schema\SchemaInterface;

/**
 * MigrationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Migration
*/
interface MigrationInterface
{
    /**
     * Create schema table (migrate)
     *
     * @param SchemaInterface $schema
     *
     * @return void
    */
    public function up(SchemaInterface $schema): void;






    /**
     * Drop schema table or others modification (rollback)
     *
     * @param SchemaInterface $schema
     * @return void
    */
    public function down(SchemaInterface $schema): void;






    /**
     * Returns migration name, that's may be used as version
     *
     * @return string
    */
    public function getName(): string;






    /**
     * Returns the migration path
     *
     * @return string
    */
    public function getPath(): string;
}
