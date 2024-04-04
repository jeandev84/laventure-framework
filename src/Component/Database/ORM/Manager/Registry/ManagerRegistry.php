<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Registry;

use Laventure\Component\Database\ORM\Manager\Contract\ObjectManagerInterface;
use Laventure\Component\Database\ORM\Repository\Contract\ObjectRepositoryInterface;

/**
 * ManagerRegistry
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager\Registry
*/
class ManagerRegistry implements ManagerRegistryInterface
{
    /**
     * @var ObjectManagerInterface
    */
    protected ObjectManagerInterface $manager;




    /**
     * @inheritdoc
    */
    public function setManager(ObjectManagerInterface $manager): static
    {
        $this->manager = $manager;

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function getManager(): ObjectManagerInterface
    {
        return $this->manager;
    }




    /**
     * @inheritDoc
    */
    public function getRepository(string $entity): ObjectRepositoryInterface
    {
        return $this->getManager()->getRepository($entity);
    }
}
