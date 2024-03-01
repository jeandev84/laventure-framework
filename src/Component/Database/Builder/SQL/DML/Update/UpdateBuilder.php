<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Update;

use Laventure\Component\Database\Builder\SQL\Commands\Set;
use Laventure\Component\Database\Builder\SQL\Commands\Update;
use Laventure\Component\Database\Builder\SQL\Commands\Where;
use Laventure\Component\Database\Builder\SQL\Conditions\WhereBuilderTrait;
use Laventure\Component\Database\Builder\SQL\Formatter\QueryFormatter;
use Laventure\Component\Database\Builder\SQL\SqlBuilderTrait;

/**
 * UpdateBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Update
*/
class UpdateBuilder implements UpdateBuilderInterface
{
    use SqlBuilderTrait;
    use WhereBuilderTrait;


    /**
     * @var string|null
    */
    public ?string $table = null;



    /**
     * @var array
    */
    public array $set = [];



    /**
     * @inheritDoc
    */
    public function update(string $table): static
    {
        $this->table = $table;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function set($column, $value): static
    {
        $this->set[$column] = "$column = $value";

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return (new QueryFormatter())->addFormats([
            new Update($this->table),
            new Set($this->set),
            new Where($this->wheres)
        ])->format();
    }
}
