<?php

declare(strict_types=1);

namespace PHPUnitTest\Component\Database\Migrator;

use Laventure\Component\Database\Schema\Migrator\Migrator;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Service\Database\Connection\TestConnection;
use PHPUnitTest\App\Service\Migration\MigrationStack;

/**
 * MigratorTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Database\Migrator
 */
class MigratorTest extends TestCase
{
    protected Migrator $migrator;


    protected function setUp(): void
    {
        $this->migrator = new Migrator(TestConnection::make());

        $this->migrator->addMigrations(MigrationStack::getMigrations());
    }




    public function testInstall(): void
    {
        $this->migrator->install();

        $schema = $this->migrator->getSchema();

        $this->assertTrue($schema->exists($this->migrator->getTable()));
    }



    public function testMigrate(): void
    {
        $this->migrator->migrate();

        $schema = $this->migrator->getSchema();

        $this->assertTrue($schema->exists($this->migrator->getTable()));
        $this->assertTrue($schema->exists('cart'));
        $this->assertTrue($schema->exists('categories'));
        $this->assertTrue($schema->exists('products'));
        $this->assertTrue($schema->exists('goods'));
        $this->assertTrue($schema->exists('users'));
    }



    public function testRollback(): void
    {

        $this->migrator->rollback();

        $schema = $this->migrator->getSchema();

        $this->assertTrue($schema->exists($this->migrator->getTable()));
        $this->assertFalse($schema->exists('cart'));
        $this->assertFalse($schema->exists('categories'));
        $this->assertFalse($schema->exists('products'));
        $this->assertFalse($schema->exists('goods'));
        $this->assertFalse($schema->exists('users'));
    }






    public function testReset(): void
    {
        $this->migrator->reset();

        $schema = $this->migrator->getSchema();

        $this->assertFalse($schema->exists($this->migrator->getTable()));
    }




    public function testRefresh(): void
    {
        $this->migrator->refresh();

        $schema = $this->migrator->getSchema();

        $this->assertTrue($schema->exists($this->migrator->getTable()));
        $this->assertTrue($schema->exists('cart'));
        $this->assertTrue($schema->exists('categories'));
        $this->assertTrue($schema->exists('products'));
        $this->assertTrue($schema->exists('goods'));
        $this->assertTrue($schema->exists('users'));
    }
}
