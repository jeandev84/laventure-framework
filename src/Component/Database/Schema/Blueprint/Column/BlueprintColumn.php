<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint\Column;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Option\Contract\ColumnOptionInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * BlueprintColumn
 *
 * @inheritDoc
*/
class BlueprintColumn implements BlueprintColumnInterface
{
    protected bool $added = false;


    /**
     * @param TableInterface $table
     * @param ColumnInterface $column
    */
    public function __construct(
        protected TableInterface $table,
        protected ColumnInterface $column
    ) {
    }





    /**
     * @inheritDoc
    */
    public function increment(): static
    {
        $this->column->increments();

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function primary(): static
    {
        $this->column->primary();

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function unique(): static
    {
        $this->column->unique();

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function signed(): static
    {
        $this->column->signed();

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function unsigned(): static
    {
        $this->column->signed();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function default($value): static
    {
        $this->column->default($value);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function nullable(): static
    {
        $this->column->nullable();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function exists(): bool
    {
        return $this->table->hasColumn($this->getName());
    }






    /**
     * @inheritDoc
    */
    public function add(): static
    {
        $this->table->addNewColumn($this->column);

        $this->added = true;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function change(): static
    {
        $this->table->addModifyColumn($this->column);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function rename(string $to): static
    {
        $this->table->renameColumn($this->getName(), $to);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function drop(): static
    {
        $this->table->dropColumn($this->getName());

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function needsToAdd(): bool
    {
        return !$this->exists() && !$this->added;
    }




    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->column->getName();
    }





    /**
     * @inheritDoc
    */
    public function toString(): string
    {
        return $this->column->getSQL();
    }
}
