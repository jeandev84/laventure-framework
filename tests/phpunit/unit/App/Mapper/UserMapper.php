<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Mapper;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use PHPUnitTest\App\Entity\User;

/**
 * UserMapper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Data
*/
class UserMapper
{
    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(
        protected EntityManagerInterface $em
    ) {
    }





    /**
     * @param int $id
     * @return User|null
    */
    public function find(int $id): ?User
    {
        return $this->em->getDataMapper()
                        ->find($this->getClassName(), $id);
    }




    /**
     * @param User $user
     * @return int
    */
    public function save(User $user): int
    {
        return $this->em->getDataMapper()
                        ->save($user);
    }





    /**
     * @param User $user
     * @return bool
    */
    public function delete(User $user): bool
    {
        return $this->em->getDataMapper()
                        ->delete($user);
    }





    /**
     * @return string
    */
    public function getClassName(): string
    {
        return User::class;
    }
}
