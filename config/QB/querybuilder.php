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



$qb1 = $queryBuilder->insert('users')
    ->values([
        'username' => 'John',
        'password' =>  password_hash('john', PASSWORD_DEFAULT),
        'active'   => true
    ]);


dump($qb1->getSQL());

$expr = $queryBuilder->expr();

$qb2 = $queryBuilder->select('count(p.price), u.username, u.birthday, u.email')
    ->distinct(true)
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



dump($qb2->getSQL());


$qb3 = $queryBuilder->update('users', 'u')
    ->set('active', 1)
    ->set('username', 'brown')
    ->where('id = :id AND active = :active');


dump($qb3->getSQL());



$qb4 = $queryBuilder->delete('users', 'u')
    ->where('id = :id');


dump($qb4->getSQL());


/*
INSERT INTO users (username, password, active)
VALUES (:username, :password, :active);

SELECT DISTINCT count(p.price), u.username, u.birthday, u.email
FROM users u
JOIN products p ON p.id = u.product_id
LEFT JOIN cart c ON c.id = p.cart_id
WHERE u.id = :id AND u.username = :username
GROUP BY p.price
HAVING count(p.price) > 500 AND c.active = true OR p.active = true
ORDER BY p.title
LIMIT 3 OFFSET 2;

UPDATE users u
SET active = :active, username = :username
WHERE id = :id AND active = :active;

DELETE FROM users u
WHERE id = :id;
*/
