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
     * @param string $type
     * @param array $columns
     * @param string|null $key
    */
    public function __construct(
        protected string  $type,
        protected array $columns = [],
        protected ?string $key = null
    ) {
    }



    /**
     * @inheritDoc
    */
    public function getType(): string
    {
        return $this->type;
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
    public function getFirstColumn(): string
    {
        return $this->columns[0] ?? '';
    }




    /**
     * @return string
    */
    public function getColumnsAsString(): string
    {
        return join(',', $this->getColumns());
    }






    /**
     * @inheritdoc
    */
    public function getSQL(): string
    {
        return sprintf('CONSTRAINT %s', $this->key);
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->getSQL();
    }
}
