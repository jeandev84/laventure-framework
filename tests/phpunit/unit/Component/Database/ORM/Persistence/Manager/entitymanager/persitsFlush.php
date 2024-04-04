<?php


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
