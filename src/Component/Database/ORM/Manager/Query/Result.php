<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Query;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * Result
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Query
*/
class Result implements QueryResultInterface
{


    /**
     * @param EntityManagerInterface $em
     * @param QueryResultInterface $result
    */
    public function __construct(
        protected EntityManagerInterface $em,
        protected QueryResultInterface $result
    )
    {
    }




    /**
     * @inheritDoc
     *
     * @return object[]|mixed
    */
    public function all(int $fetchMode = 0): array
    {
        return $this->resolveItems(
            $this->result->all($fetchMode)
        );
    }




    /**
     * @inheritDoc
     *
     * @return object|false
    */
    public function one(int $fetchMode = 0): mixed
    {
        return $this->resolveItem(
            $this->result->one($fetchMode)
        );
    }





    /**
     * @inheritDoc
    */
    public function first(): ?object
    {
        return $this->all()[0] ?? null;
    }




    /**
     * @inheritDoc
    */
    public function assoc(): array
    {
        return $this->result->assoc();
    }




    /**
     * @inheritDoc
    */
    public function column(int $column = 0): mixed
    {
        return $this->result->column($column);
    }




    /**
     * @inheritDoc
    */
    public function columns(): mixed
    {
        return $this->result->columns();
    }




    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return $this->result->count();
    }




    /**
     * @param array $items
     * @return mixed
    */
    private function resolveItems(array $items): array
    {
        return array_map(function ($item) {
            return $this->resolveItem($item);
        }, $items);
    }




    /**
     * @param $item
     * @return mixed
    */
    public function resolveItem($item): mixed
    {
        if (is_object($item)) {
            $this->em->getUnitOfWork()->refresh($item);
            $this->em->getUnitOfWork()->merge($item);
            $this->em->initializeObject($item);
        }

        return $item;
    }
}