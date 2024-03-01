<?php

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsn;
use Laventure\Component\Database\Manager\Manager;
use Laventure\Component\Database\Schema\Table\Types\Mysql\MysqlTable;
use PHPUnitTest\App\Service\Migration\MigrationStack;


#require_once __DIR__.'/vendor/autoload.php';


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
$manager     = new Manager();
$manager->open('mysql', new Configuration($config));

# 2. Get connection
$connection = $manager->connection();


$migrator = $manager->migration();
$migrator->addMigrations(MigrationStack::getMigrations());


# 1. Migration install
#$migrator->install();

# 2. Migration migrate
#$migrator->migrate();

# 3. Migration rollback
#$migrator->rollback();

# 4 . Migration reset
#$migrator->reset();

# 5. Migration refresh
#$migrator->refresh();




/*
$mysqlTable = new MysqlTable($connection, 'goods', $connection->getDatabaseName());

#dd($mysqlTable->getAllForeignKeysOfSystem());
#dd($mysqlTable->getForeignKeys());

$mysqlTable->drop();
*/


$mysqlTable = new MysqlTable($connection, 'goods');

#dd($mysqlTable->getColumns());
#dd($mysqlTable->getColumns());
#dd($mysqlTable->listConstraints());


#dd($mysqlTable->getIndexes());

/*
$config = new \Laventure\Component\Database\Configuration\Configuration([
    'dsn' => 'mysql:host=127.0.0.1;dbname=laventure_test;charset=utf8'
]);

dd($config);
*/

$dsn = new PdoDsn(
    'mysql:host=127.0.0.1;dbname=laventure_test;charset=utf8'
);

dd($dsn);