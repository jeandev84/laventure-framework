<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\BuilderInterface;
use Laventure\Component\Database\Query\Exception\QueryException;
use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Query
*/
class Query implements QueryInterface
{
    /**
     * @var int
    */
    protected int $lastId = 0;





    /**
     * @param EntityManagerInterface $em
     * @param BuilderInterface $builder
     * @param string|null $mappedClass
    */
    public function __construct(
        protected EntityManagerInterface $em,
        protected BuilderInterface $builder,
        protected ?string $mappedClass = null
    ) {
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->builder->getSQL();
    }





    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
        return $this->builder->getParameters();
    }






    /**
     * @inheritDoc
    */
    public function execute($fetchMode = null): bool|int|array
    {
        $statement =  $this->em->createNativeQuery(
            $this->getSQL(),
            $this->getParameters()
        );

        if (!$fetchMode) {

            if(!$statement->execute()) {
                return false;
            }

            return $this->lastId = $statement->lastInsertId();
        }


        return $this->collectResults(
            $statement->map($this->getMappedClass())
                      ->fetch()
                      ->all($fetchMode)
        );
    }






    /**
     * @inheritDoc
    */
    public function fetchAll(): array
    {
        return $this->collectResults(
            $this->fetch()->all()
        );
    }




    /**
     * @inheritDoc
    */
    public function fetchOne(): ?object
    {
        return $this->collectResult(
            $this->fetch()->one()
        );
    }





    /**
     * @inheritDoc
    */
    public function fetchArray(): array
    {
        return $this->fetch()->assoc();
    }





    /**
     * @inheritDoc
    */
    public function fetchColumns(): array
    {
        return $this->fetch()->columns();
    }





    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return $this->fetch()->count();
    }




    /**
     * @inheritDoc
    */
    public function lastId(): int
    {
        return $this->lastId;
    }





    /**
     * @param array $objects
     * @return array
    */
    private function collectResults(array $objects): array
    {
        foreach ($objects as $object) {
            $this->collectResult($object);
        }

        return $objects;
    }





    /**
     * @param $object
     * @return mixed
    */
    private function collectResult($object): mixed
    {
        if (is_object($object)) {
            $this->em->persist($object);
        }

        return $object;
    }




    /**
     * @inheritDoc
    */
    public function getMappedClass(): ?string
    {
        if (!$this->mappedClass) {
            throw new QueryException("No class mapped.", [
                'context' => get_called_class()
            ]);
        }

        return $this->mappedClass;
    }




    /**
     * @return QueryResultInterface
     * @throws QueryException
    */
    private function fetch(): QueryResultInterface
    {
        return $this->em->createNativeQuery(
            $this->getSQL(),
            $this->getParameters()
        )->map($this->getMappedClass())->fetch();
    }
}
