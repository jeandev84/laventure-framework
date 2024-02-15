<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Database\Migrator;

use Laventure\Component\Database\Migrator\Migrator;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Service\Connection\Connection;

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
        $this->migrator = new Migrator(Connection::make());
     }




     public function testInstall(): void
     {
          $this->migrator->install();

          $schema = $this->migrator->getSchema();

          $this->assertTrue($schema->exists($this->migrator->getTable()));
     }



     public function testMigrate(): void
     {
         $this->assertTrue(true);
     }



     public function testRollback(): void
     {
         $this->assertTrue(true);
     }



     public function testReset(): void
     {
         $this->assertTrue(true);
     }




     public function testRefresh(): void
     {
         $this->assertTrue(true);
     }
}