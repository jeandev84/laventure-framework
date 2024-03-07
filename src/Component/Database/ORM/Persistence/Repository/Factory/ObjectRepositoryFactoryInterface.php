<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Repository\Factory;


use Laventure\Component\Database\ORM\Persistence\Repository\ObjectRepositoryInterface;

/**
 * ObjectRepositoryFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Repository\Factory
 */
interface ObjectRepositoryFactoryInterface
{
      /**
       * @param string $classname
       * @return ObjectRepositoryInterface
     */
     public function createRepository(string $classname): ObjectRepositoryInterface;
}