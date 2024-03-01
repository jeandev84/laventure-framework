<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueInterface;
use Laventure\Component\Database\Schema\Constraints\Types\Index;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign\ForeignKey;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign\ForeignKeyGenerator;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary\PrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\Unique;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteria;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;
use RuntimeException;

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
     * @var ColumnInterface[]
    */
    public array $columns = [];



    /**
     * @var string[]
    */
    public array $renameColumns = [];




    /**
     * @var string[]
    */
    public array $dropColumns = [];





    /**
     * @var ConstraintInterface[]
    */
    public array $constraints = [];





    /**
     * @param ConnectionInterface $connection
     * @param string $name
     * @param string $schemaName
    */
    public function __construct(
        protected ConnectionInterface $connection,
        protected string $name,
        protected string $schemaName = ''
    ) {
    }





    /**
     * @inheritDoc
    */
    public function addColumn(string $name, string $type, string $constraints = ''): ColumnInterface
    {
        return $this->add($this->column($name, $type, $constraints));
    }





    /**
     * @inheritDoc
    */
    public function renameColumn(string $name, string $to): static
    {
        $this->renameColumns[$name] = $this->column($name)
                                           ->rename($to)
                                           ->getSQL();
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function dropColumn(string $name): static
    {
        $this->dropColumns[$name] = $this->column($name)
                                         ->drop()
                                         ->getSQL();
        return $this;
    }






    /**
     * @inheritdoc
    */
    public function primary(array $columns): static
    {
        $this->addPrimaryKey(new PrimaryKey($columns));

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function unique(array $columns): static
    {
        $this->addUnique(new Unique($columns));

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function index(array $columns): static
    {
        $this->addIndex(new Index($columns));

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function add(ColumnInterface $column): ColumnInterface
    {
        return $this->columns[$column->getName()] = $column;
    }






    /**
     * @inheritDoc
    */
    public function addConstraint(ConstraintInterface $constraint): ConstraintInterface
    {
        return $this->constraints[] = $constraint;
    }





    /**
     * @inheritDoc
    */
    public function addPrimaryKey(PrimaryKeyInterface $primaryKey): PrimaryKeyInterface
    {
        $this->addConstraint($primaryKey);

        return $primaryKey;
    }






    /**
     * @inheritDoc
    */
    public function addForeignKey(ForeignKeyInterface $foreignKey): ForeignKeyInterface
    {
        $this->addConstraint($foreignKey);

        return $foreignKey;
    }






    /**
     * @inheritDoc
    */
    public function addIndex(IndexInterface $index): IndexInterface
    {
        $this->addConstraint($index);

        return $index;
    }





    /**
     * @inheritDoc
    */
    public function addUnique(UniqueInterface $unique): UniqueInterface
    {
        $this->addConstraint($unique);

        return $unique;
    }







    /**
     * @inheritDoc
    */
    public function string(string $name, int $length = 255): ColumnInterface
    {
        return $this->addColumn($name, "VARCHAR($length)");
    }





    /**
     * @inheritdoc
    */
    public function boolean(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'BOOLEAN');
    }





    /**
     * Support text to 65 kb
     *
     * @inheritdoc
    */
    public function text(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'TEXT');
    }





    /**
     * @inheritdoc
    */
    public function foreign(string $name): ForeignKeyInterface
    {
        return $this->addForeignKey(new ForeignKey($name));
    }




    /**
     * @param string $column
     * @return string
    */
    public function foreignKeyName(string $column): string
    {
        $key = new ForeignKeyGenerator($this->name, $column);

        return $key->generate();
    }





    /**
     * @inheritDoc
     */
    public function hasColumn(string $name): bool
    {
        return in_array($name, $this->getColumnNames());
    }






    /**
     * @inheritdoc
    */
    public function getColumnNames(): array
    {
        return array_filter($this->getColumns(), function (ColumnInterface $column) {
            return $column->getName();
        });
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
    public function exec(string $sql): mixed
    {
        return $this->connection->executeQuery($sql);
    }





    /**
     * @inheritDoc
    */
    public function statement(string $sql): QueryInterface
    {
        return $this->connection->statement($sql);
    }







    /**
     * @inheritDoc
    */
    public function update(): bool
    {
        return $this->exec(
            sprintf('ALTER TABLE %s %s;', $this->name, $this->getCriteria()->update())
        );
    }






    /**
     * @inheritDoc
     */
    public function drop(): mixed
    {
        return $this->foreignKeyChecks(function () {
            return $this->exec(sprintf('DROP TABLE %s CASCADE', $this->getName()));
        });
    }





    /**
     * @inheritDoc
    */
    public function dropIfExists(): mixed
    {
        return $this->foreignKeyChecks(function () {
            return $this->exec(sprintf('DROP TABLE IF EXISTS %s CASCADE;', $this->getName()));
        });
    }




    /**
     * @inheritDoc
     */
    public function truncate(): mixed
    {
        return $this->exec(sprintf('TRUNCATE TABLE %s;', $this->getName()));
    }




    /**
     * @inheritDoc
    */
    public function truncateCascade(): mixed
    {
        return $this->exec(sprintf('TRUNCATE TABLE CASCADE %s;', $this->getName()));
    }







    /**
     * @inheritDoc
    */
    public function hasPrimaryKey(string $key): bool
    {
        return in_array($key, $this->getPrimaryKeys());
    }



    /**
     * @inheritDoc
    */
    public function hasForeignKey(string $key): bool
    {
        return in_array($key, $this->getForeignKeys());
    }




    /**
     * @inheritDoc
    */
    public function hasIndex(string $index): bool
    {
        return in_array($index, $this->getIndexes());
    }





    /**
     * @inheritDoc
    */
    public function hasUnique(string $name): bool
    {
        return in_array($name, $this->getUniques());
    }




    /**
     * @inheritDoc
    */
    public function hasConstraint(string $key): bool
    {
        return in_array($key, $this->getConstraints());
    }





    /**
     * @inheritDoc
    */
    public function getSchemaName(): string
    {
        if (!$this->schemaName) {
           throw new RuntimeException(
       "Could not found schema name from : ". get_called_class()
           );
        }

        return $this->schemaName;
    }





    /**
     * @inheritDoc
    */
    public function getCriteria(): TableCriteriaInterface
    {
        return new TableCriteria($this);
    }






    /**
     * @param callable $func
     * @return mixed
    */
    abstract public function foreignKeyChecks(callable $func): mixed;





    /**
     * @inheritdoc
    */
    abstract public function create(): bool;







    /**
     * Create new instance of table column
     *
     * @param string $name
     * @param string $type
     * @param string $constraints
     * @return ColumnInterface
    */
    abstract public function column(string $name, string $type = '', string $constraints = ''): ColumnInterface;
}
