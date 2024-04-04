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


$definition = new Config($connection);


$em         = new EntityManager($definition);
$unitOfWork = $em->getUnitOfWork();



/*
$class = ClassMetadata::create($user);
dump(array_keys($class->identifiers));
dump(array_keys($class->singleAssociates));
dump(array_keys($class->collectionAssociates));
dd($class->attributes);
*/

/*
dump(ClassMetadata::create($user)->fieldValues);
dump(ClassMetadata::create($user)->identifierValues);
dd(ClassMetadata::create($user)->isNew());
#$em->persist($user);
$class = ClassMetadata::create($user);
#dd($class->getAttributes());

$michel = new User();
$michel->setUsername('michel')
       ->setEmail('michel@gmail.com')
       ->setPassword(EncryptedPassword::encrypt('michel'));

$persistent = $unitOfWork->getPersistent($michel);

$persistent->insert();

$brown = new User();
$brown->setUsername('brown')
       ->setEmail('brown@gmail.com')
       ->setActive(true)
       ->setPassword(EncryptedPassword::encrypt('brown'));

$persistent = $unitOfWork->getPersistent($brown);

$persistent->insert();

dd($persistent);
*/

/*
$jeniffer = new User();
$jeniffer->setUsername('jeniffer')
       ->setEmail('jeniffer@gmail.com')
       ->setActive(true)
       ->setPassword(EncryptedPassword::encrypt('jeniffer'));


$em->persist($jeniffer);

$em->flush();
*/


$config = [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'port' => 3306,
    'database' => 'laventure_test',
    'charset' => 'utf8',
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


$em = new EntityManager($definition);
$unitOfWork = $em->getUnitOfWork();

/*
$john = new User();
$john->setUsername('john')
     ->setEmail('john@doe.com')
     ->setPassword(EncryptedPassword::encrypt('john'));

$persistent = $unitOfWork->getPersistent($john);

$persistent->insert();

dd($persistent);
*/


/*
$class = ClassMetadata::create($user);
dump(array_keys($class->identifiers));
dump(array_keys($class->singleAssociates));
dump(array_keys($class->collectionAssociates));
dd($class->attributes);
*/

/*
dump(ClassMetadata::create($user)->fieldValues);
dump(ClassMetadata::create($user)->identifierValues);
dd(ClassMetadata::create($user)->isNew());
#$em->persist($user);
$class = ClassMetadata::create($user);
#dd($class->getAttributes());

$michel = new User();
$michel->setUsername('michel')
       ->setEmail('michel@gmail.com')
       ->setPassword(EncryptedPassword::encrypt('michel'));

$persistent = $unitOfWork->getPersistent($michel);

$persistent->insert();

$brown = new User();
$brown->setUsername('brown')
       ->setEmail('brown@gmail.com')
       ->setActive(true)
       ->setPassword(EncryptedPassword::encrypt('brown'));

$persistent = $unitOfWork->getPersistent($brown);

$persistent->insert();

dd($persistent);
*/

/*
$jeniffer = new User();
$jeniffer->setUsername('jeniffer')
       ->setEmail('jeniffer@gmail.com')
       ->setActive(true)
       ->setPassword(EncryptedPassword::encrypt('jeniffer'));


$em->persist($jeniffer);

$em->flush();
*/


$user = $em->createQueryBuilder()
    ->select()
    ->from(User::class, 'u')
    ->criteria(['id' => 1])
    ->getQuery()
    ->fetchOne();

#dd($em->getUnitOfWork()->getStorage());
#dd($user);

$repository = $em->getRepository(User::class);

$user = $repository->find(1);
$user = $repository->find(2);

$identityMap = $em->getUnitOfWork()->getIdentityMap();

#dd($identityMap);

dd(
    $em->getUnitOfWork()
      ->getDataMapper()
      ->find(User::class, 1)
);


/*
$book = new Book('PHP4', 'PHP4 book for advanced in php.', 345.68, 1);
#dd($em->getClassMetadata(get_class($book))->getIdentifierValues($book));

$reflection = $em->getClassMetadata($book)->getReflectionClass();
#dd($em->getClassMetadata($book));
#dump($em->getRepository(\PHPUnitTest\App\Entity\User::class));

$em->initializeObject($book);
dd(
$em->getClassMetadata($book)
    ->getReflectionClass()
    ->getProperty('id')
    ->getValue($book)
);

$user = $em->find(\PHPUnitTest\App\Entity\User::class, 1);
dd($user);
*/


$repository = $em->getRepository(User::class);

/** @var User $user */
$user = $repository->find(1);

$user->setUsername('john1')
    ->setEmail('john1@gmail.com')
    ->setActive(true);


$em->flush();


dd($em->find(User::class, 1));
