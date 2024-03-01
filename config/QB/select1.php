<?php

use Laventure\Component\Database\Connection\Extensions\PDO\Query\QueryBuilder;
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


$queryBuilder = new QueryBuilder($connection);

/*
DEMO 1:
$qb = $queryBuilder->select('count(p.price), u.username, u.birthday, u.email')
                   ->from('users', 'u')
                   ->join('products p', 'p.id = u.product_id')
                   ->leftJoin('cart c', 'c.id = p.cart_id')
                   ->where('u.id = :id')
                   ->andWhere('u.username = :username')
                   ->orWhere('u.active = :active')
                   ->setParameters([
                     'id'       => 1,
                     'username' => 'brown',
                     'active'   => true
                  ])
                  ->groupBy('p.price')
                  ->having('count(p.price) > 500')
                  ->andHaving('c.active = true')
                  ->orHaving('p.active = true')
                  ->orderBy('p.title')
                  ->limit(3)
                  ->offset(2);

echo $qb->getSQL(), PHP_EOL;
*/

/*
DEMO 2:
$expr = $qb->expr();
$andX = $expr->andX(
    $expr->eq('u.id', ':id'),
    $expr->eq('u.username', ':username')
);

echo $andX, PHP_EOL;
die;
dd($qb->expr()->andX());
dump($qb->getCriteria());
*/

$expr = $queryBuilder->expr();

$qb = $queryBuilder->select('count(p.price), u.username, u.birthday, u.email')
    ->from('users', 'u')
    ->join('products p', 'p.id = u.product_id')
    ->leftJoin('cart c', 'c.id = p.cart_id')
    ->where($expr->andX(
        $expr->eq('u.id', ':id'),
        $expr->eq('u.username', ':username')
    ))
    ->setParameters([
        'id'       => 1,
        'username' => 'brown',
        'active'   => true
    ])
    ->groupBy('p.price')
    ->having('count(p.price) > 500')
    ->andHaving('c.active = true')
    ->orHaving('p.active = true')
    ->orderBy('p.title')
    ->limit(3)
    ->offset(2);


echo $qb->getSQL(), PHP_EOL;



