<?php

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Foundation\Database\Manager\Manager;

require_once __DIR__.'/vendor/autoload.php';


$config = [
    'dsn'      => 'mysql:host=127.0.0.1;dbname=grafikart_shopping_cart;charset=utf8',
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

$qb = $connection->createQueryBuilder();

$select = $qb->select('count(p.price), u.username, u.birthday, u.email')
    ->distinct()
    ->from('users', 'u')
    ->join('products p', 'p.id = u.product_id')
    ->leftJoin('cart c', 'c.id = p.cart_id')
    #->where('u.id = :id')
    ->andWhere('u.id = :id')
    ->andWhere('u.username = :username')
    ->orWhere('u.active = :active')
    ->criteria([
        'name'    => 'Brown',
        'choices' => ['PHP', 'GoLang', 'C#']
    ])
    ->setParameters([
        'id'       => 1,
        'username' => 'brown',
        'active'   => true
    ])
    ->groupBy('p.price')
    ->having('count(p.price) > 500')
    ->orderBy('p.title')
    ->limit(3)
    ->offset(2);


#dd($select->getCriteria()->toArray());

dd($select->getSQL());
