<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Repository\Factory;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\Contract\ObjectRepositoryInterface;

/**
 * EntityRepositoryFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\DataMapper\Repository\Factory
 */
interface EntityRepositoryFactoryInterface
{
    /**
     * @param string $classname
     * @return ObjectRepositoryInterface|null
     */
    public function createRepository(string $classname): ?ObjectRepositoryInterface;




    /**
     * @param EntityManagerInterface $em
     * @param string $classname
     * @return ObjectRepositoryInterface
    */
    public function createEntityRepository(
        EntityManagerInterface $em,
        string $classname
    ): ObjectRepositoryInterface;
}
