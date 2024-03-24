<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Option\ColumnOptions;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;


/**
 * Table
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table
*/
abstract class Table implements TableInterface
{


    /**
     * @var array
    */
    protected array $columns = [];




    /**
     * @var array
    */
    protected array $create = [];




    /**
     * @var array
    */
    protected array $update = [];







    /**
     * @param ConnectionInterface $connection
     * @param string $name
    */
    public function __construct(
        protected ConnectionInterface $connection,
        protected string $name
    )
    {
    }






    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @inheritDoc
    */
    public function addColumnsFromEntity(string $entity): static
    {

    }




    /**
     * @inheritDoc
    */
    public function addColumn(string $name, string $type, array $options = []): static
    {
         $column = $this->createColumn($name, $type);

         if ($this->exists()) {
             return $this->addUpdateSQL($column->add()->getSQL());
         }

         return $this->addCreateSQL($column->getSQL());
    }





    /**
     * @inheritDoc
    */
    public function renameColumn(string $name, string $to): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function modifyColumn(string $name, array $options = []): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function dropColumn(string $name): static
    {
         return $this;
    }




    /**
     * @inheritDoc
    */
    public function hasColumn(string $name): bool
    {
        return array_key_exists($name, $this->getColumns());
    }






    /**
     * @inheritDoc
    */
    public function addTimestamps(): static
    {
         return $this;
    }






    /**
     * @inheritDoc
    */
    public function addSoftDeletes(): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addConstraint(string $key, string $constraint): static
    {

    }





    /**
     * @inheritDoc
    */
    public function addPrimaryKey(array $primaryKeys): static
    {

    }





    /**
     * @inheritDoc
    */
    public function hasPrimaryKey(string $primaryKey): bool
    {
        // TODO: Implement hasPrimaryKey() method.
    }





    /**
     * @inheritDoc
    */
    public function dropPrimaryKey(string $primaryKey): static
    {
        // TODO: Implement dropPrimaryKey() method.
    }




    /**
     * @inheritDoc
    */
    public function dropPrimaryKeys(): static
    {
        // TODO: Implement dropPrimaryKeys() method.
    }




    /**
     * @inheritDoc
    */
    public function addForeignKey(string $foreignKey): ForeignKeyInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function hasForeignKey(string $foreignKey): bool
    {

    }






    /**
     * @inheritDoc
    */
    public function addIndex(array $indexes): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addUniqueKey(array $uniqueKeys): static
    {
       return $this;
    }




    /**
     * @inheritDoc
    */
    public function setIdentifier(string $identifier): static
    {
        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getIdentifier(): string
    {

    }





    /**
     * @inheritDoc
    */
    public function exec(string $sql): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function statement(string $sql): QueryInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function insert(array $attributes): static
    {

    }





    /**
     * @inheritDoc
    */
    public function set(string $column, mixed $value): static
    {

    }





    /**
     * @inheritDoc
    */
    public function delete($id): static
    {

    }





    /**
     * @inheritDoc
    */
    public function exists(): bool
    {
       return in_array($this->getName(), $this->list());
    }





    /**
     * @inheritDoc
    */
    public function list(): array
    {
        return $this->connection->getDatabase()->getTables();
    }





    /**
     * @inheritDoc
    */
    public function rename(string $to): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function update(): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function save(): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function drop(): mixed
    {

    }





    /**
     * @inheritDoc
    */
    public function truncateCascade(): mixed
    {

    }





    /**
     * @inheritDoc
    */
    public function clear(): void
    {

    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return join(';', array_filter([
            $this->getCreateSQL(),
            $this->getUpdateSQL()
        ]));
    }





    /**
     * @param string $sql
     * @return $this
    */
    public function addCreateSQL(string $sql): static
    {
        $this->create[] = $sql;

        return $this;
    }





    /**
     * @param string $sql
     * @return $this
    */
    public function addUpdateSQL(string $sql): static
    {
         $this->update[] = $sql;

         return $this;
    }


    
    
    
    /**
     * @param string $name
     * @param string $type
     * @param array $options
     * @return ColumnInterface
    */
    abstract public function createColumn(
        string $name,
        string $type,
        array $options = []
    ): ColumnInterface;






    /**
     * Returns create SQL
     *
     * @return string
    */
    abstract public function getCreateSQL(): string;






    /**
     * Returns update SQL
     *
     * @return string
    */
    abstract public function getUpdateSQL(): string;
}
