<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Repository;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Manager\Repository\ServiceEntityRepository;
use PHPUnitTest\App\Entity\User;

/**
 * UserRepository
 *
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
*/
class UserEntityRepository extends ServiceEntityRepository
{
    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, User::class);
    }
}
