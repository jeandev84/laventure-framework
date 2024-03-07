<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Repository\Factory;

use Laventure\Component\Database\ORM\Persistence\Manager\ObjectManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepository;
use Laventure\Component\Database\ORM\Persistence\Repository\ObjectRepositoryInterface;

/**
 * EntityRepositoryFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Repository\Factory
*/
class EntityRepositoryFactory implements EntityRepositoryFactoryInterface
{

    /**
     * @inheritDoc
    */
    public function createRepository(string $classname): ?ObjectRepositoryInterface
    {
         return null;
    }




    /**
     * @inheritDoc
    */
    public function createEntityRepository(
        ObjectManagerInterface $em,
        string $classname
    ): ObjectRepositoryInterface
    {
        return new EntityRepository($em, $em->getClassMetadata($classname));
    }
}