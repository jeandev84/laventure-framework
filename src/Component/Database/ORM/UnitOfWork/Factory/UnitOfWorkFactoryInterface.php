<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\UnitOfWork\Factory;


use Laventure\Component\Database\ORM\Persistence\Manager\ObjectManagerInterface;
use Laventure\Component\Database\ORM\UnitOfWork\UnitOfWorkInterface;

/**
 * UnitOfWorkFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\UnitOfWork\Factory
 */
interface UnitOfWorkFactoryInterface
{

     /**
      * @param ObjectManagerInterface|null $manager
      * @return UnitOfWorkInterface
     */
     public function createUnitOfWork(ObjectManagerInterface $manager = null): UnitOfWorkInterface;
}