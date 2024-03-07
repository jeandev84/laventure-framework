<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapper\Data;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;

/**
 * DataMapper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapper\Data
*/
class DataMapper implements DataMapperInterface
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



    /**
     * @inheritDoc
    */
    public function find($id): ?object
    {
        return $this->em->getUnitOfWork()->find($id);
    }




    /**
     * @inheritDoc
    */
    public function save(object $object): int
    {
        return 0;
    }




    /**
     * @inheritDoc
    */
    public function delete(object $object): bool
    {
        return false;
    }




    /**
     * @param object $object
     * @return int
    */
    public function insert(object $object): int
    {
        return 0;
    }




    /**
     * @param object $object
     * @return mixed
    */
    public function update(object $object): mixed
    {
        return $object;
    }




    /**
     * @param object $object
     * @return array
    */
    protected function mapRows(object $object): array
    {
        return [];
    }
}
