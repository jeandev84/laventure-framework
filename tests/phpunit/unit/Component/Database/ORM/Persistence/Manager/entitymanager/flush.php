<?php

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\ORM\Manager\Config\Config;
use Laventure\Component\Database\ORM\Manager\EntityManager;
use Laventure\Foundation\Database\Manager\Manager;
use PHPUnitTest\App\Entity\User;

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
/*
$metadata = new ClassMetadata(Book::class);

dump($metadata->getFieldNames());
dd($metadata->hasField('title'));
*/

$definition = new Config($connection);
$em         = new EntityManager($definition);


$repository = $em->getRepository(User::class);

/** @var User $user */
$user = $repository->find(1);

$user->setUsername('john1')
    ->setEmail('john1@gmail.com')
    ->setActive(true);


$em->flush();


dd($em->find(User::class, 1));
