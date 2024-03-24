<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteria;
use ReflectionClass;
use ReflectionException;


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
     * @var TableCriteria
    */
    protected TableCriteria $criteria;




    /**
     * @param ConnectionInterface $connection
     * @param string $name
    */
    public function __construct(
        protected ConnectionInterface $connection,
        protected string $name
    )
    {
        $this->criteria = new TableCriteria();
    }






    /**
     * @param string $sql
     * @return mixed
    */
    public function exec(string $sql): mixed
    {
        return $this->connection->executeQuery($sql);
    }





    /**
     * @param string $sql
     * @return QueryInterface
    */
    public function statement(string $sql): QueryInterface
    {
        return $this->connection->statement($sql);
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
     * @throws ReflectionException
    */
    public function addColumnsFromEntity(string $entity): static
    {
          $reflection = new ReflectionClass($entity);

          return $this;
    }





    /**
     * @inheritDoc
    */
    public function addColumn(string $name, string $type, array $options = []): static
    {
         $column = $this->createColumn($name, $type, $options);

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

    }





    /**
     * @inheritDoc
    */
    public function dropPrimaryKey(string $primaryKey): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function dropPrimaryKeys(): static
    {
        return $this;
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
    public function exists(): bool
    {
       return in_array($this->getName(), $this->list());
    }






    /**
     * @inheritDoc
    */
    public function rename(string $to): bool|int
    {
        return $this->exec("ALTER TABLE RENAME $this->name TO $to");
    }






    /**
     * @inheritDoc
    */
    public function create(): bool
    {
        $this->exec($this->getCreateTableSQL());

        return $this->exists();
    }





    /**
     * @inheritDoc
    */
    public function update(): mixed
    {
        return $this->exec($this->getUpdateTableSQL());
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
    public function truncate(): mixed
    {
        return $this->exec(
            sprintf('TRUNCATE TABLE %s;', $this->getName())
        );
    }






    /**
     * @inheritDoc
    */
    public function truncateCascade(): mixed
    {
        return $this->exec(
            sprintf('TRUNCATE TABLE CASCADE %s;', $this->getName())
        );
    }





    /**
     * @inheritDoc
    */
    public function dropIfExists(): mixed
    {

    }





    /**
     * @inheritDoc
    */
    public function dropCascade(): mixed
    {
        return $this->exec(
            sprintf('DROP TABLE %s CASCADE', $this->getName())
        );
    }





    /**
     * @inheritDoc
    */
    public function list(): array
    {
        return $this->connection
                    ->getDatabase()
                    ->getTables();
    }






    /**
     * @inheritDoc
    */
    public function clear(): void
    {
       $this->criteria->clear();
    }







    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return join(';', array_filter([
            $this->getCreateTableSQL(),
            $this->getUpdateTableSQL()
        ]));
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
    public function insert(array $attributes): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function set(string $column, mixed $value): static
    {
        return $this;
    }





    /**
     * @inheritDoc
     */
    public function delete($id): static
    {
        return $this;
    }






    /**
     * @inheritDoc
    */
    public function save(): mixed
    {

    }









    /**
     * @param string $sql
     * @return $this
     */
    public function addCreateSQL(string $sql): static
    {
        $this->criteria->create[] = $sql;

        return $this;
    }





    /**
     * @param string $sql
     * @return $this
     */
    public function addUpdateSQL(string $sql): static
    {
        $this->criteria->update[] = $sql;

        return $this;
    }





    /**
     * Returns create SQL
     *
     * @return string
    */
    public function getCreateTableSQL(): string
    {
        return $this->getBuilder()
                    ->getCreateTableSQL();
    }






    /**
     * Returns update SQL
     *
     * @return string
    */
    public function getUpdateTableSQL(): string
    {
        return $this->getBuilder()
                   ->getUpdateTableSQL();
    }
}
