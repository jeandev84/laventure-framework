<?php

use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Schema\Column\Drivers\Mysql\MysqlColumn;
use Laventure\Component\Database\Schema\Table\Drivers\Mysql\MysqlTable;


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


/*
$mysqlTable = new MysqlTable($connection, 'goods', $connection->getDatabaseName());

dd($mysqlTable->getAllForeignKeysOfSystem());
dd($mysqlTable->getForeignKeys());

#$mysql = new MysqlDatabase($connection, 'laventure_test');
#$mysqlTable = new MysqlTable($connection, 'goods');
#dd($mysqlTable->getColumnsInfo());


$migrator = new Migrator($connection);
$migrator->addMigrations(MigrationStack::getMigrations());
$migrator->reset();
*/