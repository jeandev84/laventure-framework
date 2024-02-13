<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Insert;

use Laventure\Component\Database\Builder\SQL\BuilderTrait;
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
    use BuilderTrait;



    /**
     * @inheritDoc
    */
    public function insert(string $table): static
    {
        $this->criteria->table($table);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function values(array $values): static
    {
        $this->criteria->insert = array_keys($values);
        $this->criteria->values[] = $values;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function setValue(string $column, $value, int $index = 0): static
    {
        if (!isset($this->criteria->values[$index])) {
            $this->criteria->values[$index] = [];
        }

        $this->criteria->insert[$column] = $column;
        $this->criteria->values[$index][$column] = $value;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->formatter->addFormats([
            new Insert(
                $this->criteria->table,
                $this->criteria->insert,
                $this->criteria->values
            )
        ])->format();
    }



    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return 'insert';
    }
}