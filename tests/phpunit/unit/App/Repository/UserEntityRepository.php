<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Repository;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\ServiceEntityRepository;
use PHPUnitTest\App\Entity\User;

/**
 * UserRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Repository
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
