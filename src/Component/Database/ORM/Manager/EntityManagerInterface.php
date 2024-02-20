<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager;

use Laventure\Component\Database\ORM\Repository\EntityRepositoryInterface;

/**
 * EntityManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Manager
 */
interface EntityManagerInterface extends ObjectManagerInterface
{

     /**
      * @param string $classname
      * @return EntityRepositoryInterface
     */
     public function getRepository(string $classname): EntityRepositoryInterface;
}
