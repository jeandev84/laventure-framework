<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Mapper;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Mapper\Data\DataMapperInterface;
use Laventure\Component\Database\ORM\Mapper\Data\Factory\DataMapperFactoryInterface;

/**
 * DataMapperFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data\Data\Factory
*/
class DataMapperFactory implements DataMapperFactoryInterface
{


    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(
        protected EntityManagerInterface $em
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function createDataMapper(): DataMapperInterface
    {
        return new DataMapper($this->em);
    }
}