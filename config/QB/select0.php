<?php

/*
$manager     = new DatabaseManager();
$manager->open('mysql', require __DIR__.'/config/database.php');

$connection = $manager->connection();


$select = new SelectBuilder($connection);

#$select->select("u.id, u.name, u.city");

$select->select('count(p.price), u.username, u.birthday, u.email')
       ->from('users u')
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
       ->orderBy('p.title')
       ->limit(3)
       ->offset(2);

dump($select->getCriteria());

echo $select->getSQL(), PHP_EOL;
*/
