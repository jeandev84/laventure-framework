<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapper\Data\Common;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapper\Data\DataMapperInterface;

/**
 * ObjectMapper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\DataMapper\DataMapper\Data\Common
*/
abstract class ObjectMapper implements DataMapperInterface
{
    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;




    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
