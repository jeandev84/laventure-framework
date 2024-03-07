<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\UnitOfWork\Factory;

use Laventure\Component\Database\ORM\Persistence\Manager\ObjectManagerInterface;
use Laventure\Component\Database\ORM\Persistence\UnitOfWork\UnitOfWork;
use Laventure\Component\Database\ORM\Persistence\UnitOfWork\UnitOfWorkInterface;

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
        ObjectManagerInterface $manager = null
    ): UnitOfWorkInterface {
        return new UnitOfWork($manager);
    }
}
