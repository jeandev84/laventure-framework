<?php

use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilder;
use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Mysql\MysqlConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Column\Drivers\Mysql\MysqlColumn;
use Laventure\Component\Database\Schema\Schema;


require_once __DIR__.'/vendor/autoload.php';


$config = [
    #'dsn' => 'mysql:host=127.0.0.1;dbname=grafikart_shopping_cart;charset=utf8',
    'dsn' => 'mysql:host=127.0.0.1;dbname=laventure_test;charset=utf8',
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


/*
# 5. Get table

#$schema->drop('goods');
#$schema->drop('users');

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
$table->create();

#dump($table->create());
#$table->drop();
#dd($table->list());

$table = $schema->table('goods');
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

$table->create();
# dd($table->createCriteria());

dump($schema->exists('users'));
dump($schema->exists('goods'));


dump($schema->dropIfExists('migrations'));
dump($schema->dropIfExists('demo'));
dump($schema->dropIfExists('goods'));
dump($schema->dropIfExists('users'));
dump($schema->dropIfExists('cart'));
dump($schema->dropIfExists('categories'));
dump($schema->dropIfExists('products'));


$schema->create('cart', function (Blueprint $table) {
   $table->integer('id')->primary()->increment();
   $table->string('title');
});


$schema->create('categories', function (Blueprint $table) {
    $table->integer('id')->primary()->increment();
    $table->string('title');
});


$schema->create('products', function (Blueprint $table) {
    $table->integer('id')->primary()->increment();
    $table->string('name');
    $table->boolean('test')->default(0);
    $table->float('price');
});


$qb = $connection->createQueryBuilder();

$qb->insert('products', [
    [
        'name'  => 'Tourelle de Defense',
        'price' => 150.20
    ],
    [
        'name'  => 'Tourelle de niveau 3',
        'price' => 125
    ]
])->getQuery()->execute();


dump($schema->exists('cart'));
dump($schema->exists('categories'));
dump($schema->exists('products'));
*/