<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Column\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Types\Index;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign\ForeignKey;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary\PrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\Unique;

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
    protected array $addColumns = [];



    /**
     * @var ColumnInterface[]
    */
    protected array $removeColumns = [];




    /**
     * @var ColumnInterface[]
    */
    protected array $dropColumns = [];





    /**
     * @var ConstraintInterface[]
    */
    protected array $constraints = [];




    /**
     * @param ConnectionInterface $connection
     * @param string $name
    */
    public function __construct(
        protected ConnectionInterface $connection,
        protected string $name
    ) {
    }





    /**
     * @inheritDoc
    */
    public function addColumn(string $name, string $type, string $constraints = ''): ColumnInterface
    {
        return $this->add($this->createColumn($name, $type, $constraints));
    }





    /**
     * @inheritDoc
    */
    public function renameColumn(string $name, string $to): static
    {
        $this->removeColumns[$name] = $this->createColumn($name)->rename($to);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function dropColumn(string $name): static
    {
        $this->dropColumns[$name] = $this->createColumn($name)->drop();

        return $this;
    }







    /**
     * @param ColumnInterface $column
     * @return ColumnInterface
    */
    public function add(ColumnInterface $column): ColumnInterface
    {
        return $this->addColumns[$column->getName()] = $column;
    }






    /**
     * @inheritDoc
    */
    public function addConstraint(ConstraintInterface $constraint): ConstraintInterface
    {
        return $this->constraints[$constraint->getName()] = $constraint;
    }





    /**
     * @inheritDoc
    */
    public function addPrimaryKey(PrimaryKey $primaryKey): PrimaryKey
    {
        $this->addConstraint($primaryKey);

        return $primaryKey;
    }






    /**
     * @inheritDoc
    */
    public function addForeignKey(ForeignKey $foreignKey): ForeignKey
    {
        $this->addConstraint($foreignKey);

        return $foreignKey;
    }






    /**
     * @inheritDoc
    */
    public function addIndex(Index $index): Index
    {
        $this->addConstraint($index);

        return $index;
    }





    /**
     * @inheritDoc
    */
    public function addUnique(Unique $unique): Unique
    {
        $this->addConstraint($unique);

        return $unique;
    }






    /**
     * @inheritDoc
    */
    public function addTimestamps(): static
    {
        return $this;
    }






    /**
     * Returns column names
     *
     * @return string[]
    */
    public function getColumnNames(): array
    {
        $func = function (ColumnInterface $column) {
            return $column->getName();
        };

        return array_filter($this->getColumns(), $func);
    }






    /**
     * @inheritDoc
    */
    public function hasColumn(string $name): bool
    {
        return in_array($name, $this->getColumnNames());
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
    public function update(): bool
    {
        return false;
    }






    /**
     * @inheritDoc
    */
    public function drop(): bool
    {
        $this->exec(sprintf('DROP TABLE %s', $this->getName()));

        return $this->exists();
    }





    /**
     * @inheritDoc
    */
    public function dropIfExists(): bool
    {
        $this->exec(sprintf('DROP TABLE IF EXISTS %s;', $this->getName()));

        return $this->exists();
    }




    /**
     * @inheritDoc
    */
    public function truncate(): bool
    {
        return $this->exec(sprintf('TRUNCATE TABLE %s;', $this->getName()));
    }




    /**
     * @inheritDoc
    */
    public function truncateCascade(): bool
    {
        return $this->exec(sprintf('TRUNCATE TABLE CASCADE %s;', $this->getName()));
    }




    /**
     * @inheritDoc
    */
    public function exec(string $sql): bool
    {
        return $this->connection->executeQuery($sql);
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
        return $this->connection->getDatabase()->getSchemas();
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
     * @inheritdoc
    */
    public function text(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'TEXT');
    }





    /**
     * @inheritDoc
    */
    public function default($value): static
    {
        foreach ($this->getColumns() as $column) {
            $this->add($column->default($value));
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function unsigned(string $name): mixed
    {
        // TODO: Implement unsigned() method.
    }





    /**
     * Create new instance of table column
     *
     * @param string $name
     * @param string $type
     * @param string $constraints
     * @return ColumnInterface
    */
    abstract public function createColumn(string $name, string $type = '', string $constraints = ''): ColumnInterface;
}
