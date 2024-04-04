<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\UnitOfWork\Factory;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Manager\UnitOfWork\UnitOfWork;
use Laventure\Component\Database\ORM\UnitOfWork\Factory\UnitOfWorkFactoryInterface;
use Laventure\Component\Database\ORM\UnitOfWork\UnitOfWorkInterface;

/**
 * UnitOfWorkFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\UnitOfWork\Factory
*/
class UnitOfWorkFactory implements UnitOfWorkFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createUnitOfWork(
        EntityManagerInterface $manager
    ): UnitOfWorkInterface {
        return new UnitOfWork($manager);
    }
}
