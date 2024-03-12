<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Repository;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;

/**
 * ServiceRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Repository
*/
class ServiceEntityRepository extends EntityRepository
{
    /**
     * @param EntityManagerInterface $em
     * @param string $classname
    */
    public function __construct(EntityManagerInterface $em, string $classname)
    {
        parent::__construct($em, $em->getClassMetadata($classname));
    }
}
