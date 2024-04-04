<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Registry;

use Laventure\Component\Database\ORM\Manager\Contract\ObjectManagerInterface;
use Laventure\Component\Database\ORM\Repository\Contract\ObjectRepositoryInterface;

/**
 * ManagerRegistryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Registry
 */
interface ManagerRegistryInterface
{
    /**
     * @param ObjectManagerInterface $manager
     * @return $this
    */
    public function setManager(ObjectManagerInterface $manager): static;



    /**
     * Returns manager
     *
     * @return ObjectManagerInterface
    */
    public function getManager(): ObjectManagerInterface;





    /**
     * Returns entity repository
     *
     * @param string $entity
     * @return ObjectRepositoryInterface
    */
    public function getRepository(string $entity): ObjectRepositoryInterface;
}
