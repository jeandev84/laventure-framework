<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Repository\Factory;

use Laventure\Component\Database\ORM\Repository\Contract\ObjectRepositoryInterface;

/**
 * EntityRepositoryFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Repository\Factory
 */
interface EntityRepositoryFactoryInterface
{
    /**
     * @param string $classname
     * @return ObjectRepositoryInterface|null
     */
    public function createRepository(string $classname): ?ObjectRepositoryInterface;


    /**
     * @param string $classname
     * @return ObjectRepositoryInterface
    */
    public function createEntityRepository(string $classname): ObjectRepositoryInterface;
}
