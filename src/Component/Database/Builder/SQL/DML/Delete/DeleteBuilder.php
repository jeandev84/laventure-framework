<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Delete;

use Laventure\Component\Database\Builder\SQL\Commands\Delete;
use Laventure\Component\Database\Builder\SQL\Commands\Where;
use Laventure\Component\Database\Builder\SQL\Conditions\WhereBuilderTrait;
use Laventure\Component\Database\Builder\SQL\Formatter\QueryFormatter;
use Laventure\Component\Database\Builder\SQL\SqlBuilderTrait;

/**
 * DeleteBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Delete
*/
class DeleteBuilder implements DeleteBuilderInterface
{
    use SqlBuilderTrait;
    use WhereBuilderTrait;

    protected $table = null;

    /**
     * @inheritDoc
    */
    public function delete(string $table): static
    {
        $this->table = $table;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getCommands(): array
    {
        return [
            new Delete($this->table),
            new Where($this->wheres)
        ];
    }
}
