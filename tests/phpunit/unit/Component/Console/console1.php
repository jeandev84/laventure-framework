<?php

use Laventure\Component\Console\Command\Defaults\HelpCommand;
use Laventure\Component\Console\Console;
use Laventure\Component\Console\Input\Types\Argv\ConsoleInputArgv;
use Laventure\Component\Console\Output\ConsoleOutput;
use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\ORM\Manager\Config\Config;
use Laventure\Component\Database\ORM\Manager\EntityManager;
use Laventure\Foundation\Database\Manager\Manager;
use PHPUnitTest\App\Commands\HelloCommand;
use PHPUnitTest\App\Commands\Migration\MigrateCommand;

require_once __DIR__.'/vendor/autoload.php';


$config = [
    'driver'   => 'mysql',
    'host'     => '127.0.0.1',
    'port'     => 3306,
    'database' => 'laventure_test',
    'charset'  => 'utf8',
    'username' => 'root',
    'password' => 'secret',
    'options' => [
        #PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    ]
];


# 1. Initialize database manager
$manager = new Manager();
$manager->open('mysql', new Configuration($config));



# 2. Get connection
$connection = $manager->connection();


# 3. Data (ClassMetadata)

$definition = new Config($connection);
$em         = new EntityManager($definition);


$tokens = $_SERVER['argv'];

$console = new Console();
$console->addCommands([
    new HelpCommand(),
    new HelloCommand(),
    new MigrateCommand(),
]);

$input  = new ConsoleInputArgv();
$output = new ConsoleOutput();

$status = $console->run($input, $output);
