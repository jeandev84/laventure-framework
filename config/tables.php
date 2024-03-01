<?php

use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilder;
use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Mysql\MysqlConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Schema\Column\Drivers\Mysql\MysqlColumn;
use Laventure\Component\Database\Schema\Schema;


require_once __DIR__.'/vendor/autoload.php';


$config = [
    'dsn' => 'mysql:host=127.0.0.1;dbname=grafikart_shopping_cart;charset=utf8',
    'username' => 'root',
    'password' => 'secret',
    'options' => [
        #PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    ]
];

# 1. Initialize database manager
$manager     = new DatabaseManager();
$manager->open('mysql', $config);

# 2. Get connection
$connection = $manager->connection();


# 3. Get database schemas
$schemas = $connection->getDatabase()->getTables();
# dump($schemas); products

# 4. Create new schema
$schema = new Schema($connection);


# 5. Get table
$table = $schema->table('products');
# dump($table->getColumns());
# dump($table->exists());
# dump($table->getIndexes());
/*
 0 => array:15 [
    "Table" => "products"
    "Non_unique" => 0
    "Key_name" => "PRIMARY"
    "Seq_in_index" => 1
    "Column_name" => "id"
    "Collation" => "A"
    "Cardinality" => 2
    "Sub_part" => null
    "Packed" => null
    "Null" => ""
    "Index_type" => "BTREE"
    "Comment" => ""
    "Index_comment" => ""
    "Visible" => "YES"
    "Expression" => null
  ]
*/


# 5. Get table
$table = $schema->table('users');
# dump($table->getColumns());
# dump($table->exists());
# dump($table->getIndexes());

# 6. Create table
$table->increments('id');
$table->string('username', 150);
$table->string('email', 150);
$table->string('password', 230);
$table->boolean('active');
$table->addTimestamps();
$table->index(['username']);
# dump($table->getCreateCriteria());

#dump($table->create());
#$table->drop();
#dd($table->list());

$table = $schema->table('products');
$table->increments('id');
$table->string('title', 200);
$table->string('slug', 300);
$table->text('description');
$table->float('price');
$table->string('image', 350);
$table->boolean('in_stock');
$table->addTimestampsNullable();
$table->addSoftDeletesTimestamps();
$table->bigInteger('user_id');
$table->foreign('user_id')
    ->references('id')
    ->on('users')
    ->onDelete('cascade');

/*dd($table->createCriteria());*/



