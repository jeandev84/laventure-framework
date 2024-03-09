<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager\Fixtures\Contract;


use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;

/**
 * FixtureInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Fixtures\Contract
 */
interface FixtureInterface
{
     /**
      * @param EntityManagerInterface $em
      * @return mixed
     */
     public function load(EntityManagerInterface $em): mixed;
}