<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints;

/**
 * Constraint
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints
*/
abstract class Constraint implements ConstraintInterface
{
    /**
     * @var array
    */
    protected array $columns = [];


    /**
     * @param string $name
     * @param string|null $key
    */
    public function __construct(
        protected string $name,
        protected ?string $key = null
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
    public function getKey(): ?string
    {
        return $this->key;
    }



    /**
     * @inheritDoc
    */
    public function withColumns(array $columns): static
    {
        $this->columns = array_merge($this->columns, $columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withColumn(string $column): static
    {
        $this->columns[] = $column;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getColumns(): array
    {
        return $this->columns;
    }




    /**
     * @return bool
    */
    public function hasColumns(): bool
    {
        return !empty($this->columns);
    }




    /**
     * @return string
    */
    public function getColumnsAsString(): string
    {
        return join(',', $this->getColumns());
    }





    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->getSQL();
    }
}
