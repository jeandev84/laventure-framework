<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Insert;

use Laventure\Component\Database\Builder\SQL\Formatter\QueryFormatter;
use Laventure\Component\Database\Builder\SQL\SQlBuilderTrait;
use Laventure\Component\Database\Builder\SQL\Expr\Insert;

/**
 * InsertBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Insert
 */
class InsertBuilder implements InsertBuilderInterface
{
    use SQlBuilderTrait;


    /**
     * @var string|null
    */
    public ?string $table = null;



    /**
     * @var array
    */
    public array $insert = [];



    /**
     * @var array
    */
    public array $values = [];




    /**
     * @inheritDoc
    */
    public function insert(string $table): static
    {
        $this->table = $table;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function values(array $values): static
    {
        $this->insert = array_keys($values);
        $this->values[] = $values;

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

        if (!isset($this->values[$index])) {
            $this->values[$index] = [];
        }

        $this->insert[$column] = $column;
        $this->values[$index][$column] = $value;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return (new QueryFormatter())->addFormats([
            new Insert(
                $this->table,
                $this->insert,
                $this->values
            )
        ])->format();
    }
}
