<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Database\Schema;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Schema;
use Laventure\Component\Database\Schema\Table\Drivers\Mysql\MysqlTable;
use Laventure\Component\Database\Schema\Table\TableInterface;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Service\Connection\Connection;

/**
 * SchemaTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Database\Schema
*/
class SchemaTest extends TestCase
{

       protected ConnectionInterface $connection;


       protected function setUp(): void
       {
           $this->connection = Connection::make();
       }




       public function testItCanCreateTable(): void
       {
            $schema = new Schema($this->connection);

            $table = $schema->table('users');

            # 1. Determine instances of $table
            $this->assertInstanceOf(TableInterface::class, $table);
            $this->assertInstanceOf(MysqlTable::class, $table);


            # 2. Creating table "users"
            $table->increments('id');
            $table->string('username', 150);
            $table->string('email', 180);
            $table->string('password', 230);
            $table->boolean('active');
            $table->addTimestamps();
            $table->unique(['email']);
            $table->create();


            # 3. Determine if table "users" created
            $this->assertTrue($table->exists());


            // Drop "users" table
            $table->drop();

            # 4. Determine if table "users" is dropped
            $this->assertFalse($table->exists());


            # 5. Recreate "users" table
            $schema->create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('username', 150);
                $table->string('email', 180);
                $table->string('password', 230);
                $table->boolean('active');
                $table->timestamps();
                $table->softDeletes();
                $table->unique(['email']);
            });

            # 6. Determine if table is recreated
            $this->assertTrue($schema->exists('users'));

       }
}