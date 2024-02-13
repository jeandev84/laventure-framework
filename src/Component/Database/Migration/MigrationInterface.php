<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Migration;


use Laventure\Component\Database\Schema\SchemaInterface;

/**
 * MigrationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Migration
*/
interface MigrationInterface
{

    /**
     * Create or modify schema table
     *
     * @param SchemaInterface $schema
     *
     * @return void
    */
    public function up(SchemaInterface $schema): void;






    /**
     * Drop schema table or others modification
     *
     * @param SchemaInterface $schema
     * @return void
    */
    public function down(SchemaInterface $schema): void;
}