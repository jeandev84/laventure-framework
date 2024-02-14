<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Column\ColumnInterface;

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
    public function getName(): string
    {
        return $this->name;
    }




    /**
     * @inheritDoc
    */
    public function create(): mixed
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
    public function drop(): mixed
    {

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
    public function truncate(): mixed
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
    public function exists(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function list(): array
    {

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
     * @inheritDoc
    */
    public function addTimestamps(): static
    {

    }



    /**
     * @inheritDoc
    */
    public function addForeignKey($foreignKey): static
    {

    }




    /**
     * @inheritDoc
    */
    public function addIndex($index): static
    {

    }




    /**
     * @inheritDoc
    */
    public function addConstraint($constraint): static
    {

    }




    /**
     * Returns column names
     *
     * @return string[]
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
    public function hasColumn(string $name): bool
    {
        return in_array($name, $this->getColumnNames());
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
     * Create new instance of table column
     *
     * @param string $name
     * @param string $type
     * @param string $constraints
     * @return ColumnInterface
    */
    abstract public function createColumn(string $name, string $type = '', string $constraints = ''): ColumnInterface;
}
