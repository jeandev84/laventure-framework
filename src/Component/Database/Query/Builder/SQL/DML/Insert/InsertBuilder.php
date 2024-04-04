<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Insert;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Insert;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Values;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;

/**
 * InsertBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\PgsqlInsertBuilder
*/
class InsertBuilder extends SQLBuilder implements InsertBuilderInterface
{
    /**
     * @inheritDoc
    */
    public function insert(string $table): static
    {
        $this->criteria->table = $table;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function hasMultiple(array $values): bool
    {
        return isset($values[0]);
    }






    /**
     * @inheritDoc
    */
    public function values(array $values): static
    {
        if ($this->hasMultiple($values)) {
            $this->addMultipleInsert($values);
        } else {
            $this->addInsert($values);
        }

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function addMultipleInsert(array $values): static
    {
        foreach ($values as $position => $attributes) {
            foreach ($attributes as $column => $value) {
                $this->setValue($column, $value, $position);
            }
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addInsert(array $attributes): static
    {
        foreach ($attributes as $column => $value) {
            $this->setValue($column, $value);
        }

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function setValue(string $column, $value, int $index = 0): static
    {
        if ($index < 0) {
            $index = 0;
        }

        if (!isset($this->values[$index][$column])) {
            $this->criteria->values[$index][$column] = $value;
        }

        $this->criteria->columns[$column] = $column;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getCommands(): array
    {
        return [
            new Insert($this->criteria->table, $this->criteria->columns),
            new Values($this->criteria->values)
        ];
    }
}
