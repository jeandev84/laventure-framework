<?php

use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilder;
use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Mysql\MysqlConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Schema\Column\Drivers\Mysql\MysqlColumn;


require_once __DIR__.'/vendor/autoload.php';


$column1 = new MysqlColumn('id', 'INT');
$column1->primary()->increment();

$column2 = new MysqlColumn('name', 'VARCHAR(255)');
$column3 = new MysqlColumn('roles', 'VARCHAR(255)');
$column3->default('ROLE_USER');

$column4 = new MysqlColumn('address', 'TEXT');
$column4->nullable();

$column5Add = new MysqlColumn('city', 'VARCHAR(300)');
$column5Add->nullable();

$column5Modify= new MysqlColumn('name', 'VARCHAR(200)');
$column5Modify->modify();

$column5Rename = new MysqlColumn('name');
$column5Rename->rename('username');

$columnDrop = new MysqlColumn('foo');
$columnDrop->drop();

$columns = [
    $column1,
    $column2,
    $column3,
    $column4,
    $column5Add,
    $column5Modify,
    $column5Rename,
    $columnDrop
];

foreach ($columns as $column) {
    echo $column->getSQL(), PHP_EOL;
}

/*
`id` INT AUTO_INCREMENT PRIMARY KEY
`name` VARCHAR(255) NOT NULL
`roles` VARCHAR(255) DEFAULT "ROLE_USER" NOT NULL
`address` TEXT DEFAULT NULL
`city` VARCHAR(300) DEFAULT NULL
MODIFY COLUMN `name` VARCHAR(200) NOT NULL
RENAME COLUMN `name` TO username NOT NULL
DROP COLUMN `foo` NOT NULL
*/









