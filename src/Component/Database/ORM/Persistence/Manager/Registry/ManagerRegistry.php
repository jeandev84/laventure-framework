<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager\Registry;

use Laventure\Component\Database\ORM\Persistence\Manager\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepositoryInterface;

/**
 * ManagerRegistry
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Manager\Registry
*/
class ManagerRegistry
{
    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;




    /**
     * @param EntityManagerInterface $em
     * @return $this
    */
    public function setManager(EntityManagerInterface $em): static
    {
        $this->em = $em;

        return $this;
    }




    /**
     * @return EntityManagerInterface
    */
    public function getManager(): EntityManagerInterface
    {
        return $this->em;
    }





    /**
     * @param string $classname
     * @return EntityRepositoryInterface
    */
    public function getRepository(string $classname): EntityRepositoryInterface
    {
        return $this->getManager()->getRepository($classname);
    }
}
