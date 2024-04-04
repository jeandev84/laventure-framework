<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Events\Common;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;

/**
 * EntityManagerEvent
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager\Events\Common
 */
abstract class EntityManagerEvent
{
    /**
     * @param EntityManagerInterface $em
   */
    public function __construct(protected EntityManagerInterface $em)
    {
    }



    /**
     * @return EntityManagerInterface
     */
    public function getManager(): EntityManagerInterface
    {
        return $this->em;
    }
}
