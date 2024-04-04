<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Persistent;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Mapping\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\Exception\NotFoundTableException;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * Persistent
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data
 */
class Persistent implements PersistentInterface
{
    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;




    /**
     * @var ClassMetadataInterface
    */
    protected ClassMetadataInterface $classMetadata;





    /**
     * @var array
    */
    public array $insert = [];





    /**
     * @var array
    */
    public array $inserted = [];




    /**
     * @var array
    */
    public array $update = [];




    /**
     * @var array
    */
    public array $updated = [];





    /**
     * @var array
    */
    public array $delete = [];





    /**
     * @var array
    */
    public array $deleted = [];




    /**
     * @param EntityManagerInterface $em
     * @param $class
     * @throws NotFoundTableException
    */
    public function __construct(EntityManagerInterface $em, $class)
    {
        $this->em            = $em;
        $this->classMetadata = $em->getClassMetadata($class);
        $this->initializeClass($this->classMetadata);
    }





    /**
     * @return QueryBuilderInterface
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {
         return $this->em->createQueryBuilder();
    }





    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {
        return $this->findOneBy([$this->getIdentifier() => $id]);
    }







    /**
     * Find object by criteria
     *
     * @param array $criteria
     * @return mixed
    */
    public function findOneBy(array $criteria): mixed
    {
        return $this->select()
                    ->from($this->getClassName(), $this->getTableAlias())
                    ->criteria($criteria)
                    ->getQuery()
                    ->fetch()
                    ->one();
    }






    /**
     * @param $columns
     * @return QueryBuilderInterface
    */
    public function select($columns = null): QueryBuilderInterface
    {
         return $this->createQueryBuilder()
                     ->select($columns)
                     ->from($this->getClassName(), $this->getTableAlias());
    }







    /**
     * @inheritDoc
    */
    public function addInsert(array $attributes): static
    {
        $this->insert[] = $attributes;

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function insert(): int
    {
        $insert = $this->createQueryBuilder()
                   ->insert($this->getTableName())
                   ->values($this->insert)
                   ->getQuery();

        $status = $insert->execute();
        $id     = $insert->lastInsertId();

        return $this->addInserted($id, $status);
    }






    /**
     * @inheritDoc
    */
    public function addUpdate($id, array $attributes): static
    {
        $this->update[$id] = $attributes;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function update(): bool
    {
        foreach ($this->update as $id => $attributes) {
            $this->addUpdated($id, $this->refresh($id, $attributes));
        }

        return !empty($this->updated);
    }





    /**
     * @inheritDoc
    */
    public function refresh($id, array $attributes): bool
    {
         $qb = $this->createQueryBuilder()
                    ->update($this->getTableName())
                    ->criteria([$this->getIdentifier() => $id]);

          foreach ($attributes as $column => $value) {
              $qb->set($column, $value);
          }

          return $qb->getQuery()->execute();
    }







    /**
     * @inheritDoc
    */
    public function addRemove($id): static
    {
        $this->delete[$id] = $id;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function delete($id): bool
    {
        return $this->createQueryBuilder()
                    ->delete($this->getTableName())
                    ->criteria([$this->getIdentifier() => $id])
                    ->getQuery()
                    ->execute();
    }





    /**
     * @inheritDoc
    */
    public function remove(): bool
    {
        foreach ($this->delete as $id) {
            $this->deleted[$id] = $this->delete($id);
        }

        return isset($this->deleted[$this->getId()]);
    }





    /**
     * @return string
    */
    public function getClassName(): string
    {
        return $this->classMetadata->getName();
    }




    /**
     * @return string
    */
    public function getClassShortName(): string
    {
        return $this->classMetadata->getShortName();
    }





    /**
     * @return string
    */
    public function getTableName(): string
    {
        return $this->classMetadata->getTableName();
    }





    /**
     * @return string
    */
    public function getTableAlias(): string
    {
        return $this->classMetadata->getTableAlias();
    }






    /**
     * @return string
    */
    public function getIdentifier(): string
    {
        return $this->classMetadata->getIdentifier();
    }





    /**
     * @return string
    */
    public function getIdentity(): string
    {
        return $this->classMetadata->getIdentityMapId();
    }





    /**
     * @param ClassMetadataInterface $class
     * @return void
     * @throws NotFoundTableException
    */
    private function initializeClass(ClassMetadataInterface $class): void
    {
        $attributes = $this->filterAttributes($class->fills());

        if ($class->isNew()) {
            $this->addInsert($attributes);
        } else {
            $this->addUpdate($class->getId(), $attributes);
            $this->addRemove($class->getId());
        }
    }




    /**
     * @return TableInterface
    */
    private function getTable(): TableInterface
    {
        return $this->em->getConnection()
                        ->table($this->getTableName());
    }






    /**
     * @param array $attributes
     * @return array
     * @throws NotFoundTableException
    */
    private function filterAttributes(array $attributes): array
    {
        $table = $this->getTable();

        if (!$table->exists()) {
            throw new NotFoundTableException($this->getTableName(), [
                'context' => "Data class {$this->getClassShortName()}"
            ]);
        }

        foreach (array_keys($attributes) as $column) {
            if (!in_array($column, $table->getColumnNames())) {
                unset($attributes[$column]);
            }
        }

        return $attributes;
    }




    /**
     * @param $id
     * @param $status
     * @return int
    */
    private function addInserted($id, $status): int
    {
        $this->inserted[$this->getClassName()][$id] = $status;

        return $id;
    }




    /**
     * @param $id
     * @param $status
     * @return int
    */
    private function addUpdated($id, $status): int
    {
        $this->updated[$this->getClassName()][$id] = $status;

        return $id;
    }





    /**
     * @return mixed
    */
    private function getId(): mixed
    {
        return $this->classMetadata->getId();
    }
}
