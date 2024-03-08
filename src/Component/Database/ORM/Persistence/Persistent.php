<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapper\Identity\IdentityMap;
use Laventure\Component\Database\ORM\Persistence\Mapper\Identity\IdentityMapperInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DQL\Select\Select;
use Laventure\Component\Database\Schema\Table\Exceptions\NotFoundTableException;
use Laventure\Component\Database\Schema\Table\Exceptions\TableException;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * Persistent
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence
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
     * @var IdentityMapperInterface|null
    */
    protected ?IdentityMapperInterface $identityMap = null;




    /**
     * @var array
    */
    protected array $insert = [];



    /**
     * @var array
    */
    protected array $inserted = [];




    /**
     * @var array
    */
    protected array $update = [];




    /**
     * @var array
    */
    protected array $updated = [];





    /**
     * @var array
    */
    protected array $delete = [];





    /**
     * @var array
    */
    protected array $deleted = [];





    /**
     * @param EntityManagerInterface $em
     * @param $entity
    */
    public function __construct(
        EntityManagerInterface $em,
        $entity
    ) {
        $this->em            = $em;
        $this->classMetadata = $em->getClassMetadata($entity);
        $this->addPersistAttributes($this->classMetadata);
    }




    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {
        $identityId  = $this->getIdentityId($id);
        $identityMap = $this->getIdentityMap();

        if ($identityMap->has($identityId)) {
            return $identityMap->get($identityId);
        }

        $data = $this->findOneBy([$this->getIdentifier() => $id]);
        $identityMap->map($identityId, $data);
        return $data;
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
                    ->fetchOne();
    }





    /**
     * @param string|null $columns
     * @return Select
    */
    public function select(string $columns = null): Select
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
        dd($this->insert);
        $id = $this->createQueryBuilder()
                   ->insert($this->getTableName(), $this->insert)
                   ->getQuery()
                   ->execute();

        $this->inserted[$this->getClassName()][] = $id;

        return $id;
    }






    /**
     * @inheritDoc
    */
    public function addUpdate($id, array $attributes): static
    {
        if (!is_null($id)) {
            $this->update[$id] = $attributes;
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function update(): bool
    {
        foreach ($this->update as $id => $attributes) {
            $status = $this->createQueryBuilder()
                           ->update($this->getTableName(), $attributes)
                           ->criteria([$this->getIdentifier(), $id])
                           ->getQuery()
                           ->execute();
            if ($status) {
                $this->updated[$this->getClassName()][$id] = $status;
            }
        }

        return !empty($this->updated);
    }




    /**
     * @inheritDoc
    */
    public function addRemove($id): static
    {

    }




    /**
     * @inheritDoc
    */
    public function remove(): mixed
    {
        return null;
    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return $this->em->createQueryBuilder();
    }




    /**
     * @inheritDoc
    */
    public function getIdentityMap(): IdentityMapperInterface
    {
        if (!$this->identityMap) {
            $this->identityMap = new IdentityMap();
        }

        return $this->identityMap;
    }





    /**
     * @inheritDoc
    */
    public function getClassMetadata(): ClassMetadataInterface
    {
        return $this->classMetadata;
    }




    /**
     * @inheritDoc
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
       return $this->classMetadata->getReflectionClass()
                                  ->getShortName();
    }



    /**
     * @inheritDoc
    */
    public function getTableName(): string
    {
        $classShortName = $this->getClassShortName();

        return mb_strtolower($classShortName) . 's';
    }





    /**
     * @inheritDoc
    */
    public function getTableAlias(): string
    {
        return $this->getTableName()[0];
    }





    /**
     * @param $id
     * @return string
    */
    public function getIdentityId($id): string
    {
        return $this->identityMap->getIdentityId(
            $this->getClassName(), $id
        );
    }





    /**
     * @return string
    */
    public function getIdentifier(): string
    {
        return $this->classMetadata->getIdentifier();
    }




    /**
     * @return array
    */
    public function getDelete(): array
    {
        return $this->delete;
    }





    /**
     * @return array
    */
    public function getDeleted(): array
    {
        return $this->deleted;
    }





    /**
     * @return array
    */
    public function getInsert(): array
    {
        return $this->insert;
    }




    /**
     * @return array
    */
    public function getInserted(): array
    {
        return $this->inserted;
    }



    /**
     * @return array
    */
    public function getUpdate(): array
    {
        return $this->update;
    }




    /**
     * @return array
    */
    public function getUpdated(): array
    {
        return $this->updated;
    }




    /**
     * @param ClassMetadataInterface $class
     * @return $this
     * @throws NotFoundTableException
    */
    private function addPersistAttributes(ClassMetadataInterface $class): static
    {
        $attributes = $this->filterAttributes($class->getPersistAttributes());
        $this->addInsert($attributes);
        $this->addUpdate($class->getId(), $attributes);

        return $this;
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
                'context' => "Persistence class {$this->getClassShortName()}"
            ]);
        }

        foreach (array_keys($attributes) as $column) {
            if (!in_array($column, $table->getColumnNames())) {
                 unset($attributes[$column]);
            }
        }

        return $attributes;
    }
}
