<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Delete;

use Laventure\Component\Database\Query\Builder\SQL\Commands\Delete;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Where;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;


/**
 * DeleteBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Delete
*/
class DeleteBuilder extends SQLBuilder implements DeleteBuilderInterface
{

    #use WhereTrait;

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
    protected function getCommands(): array
    {
        return [
            new Delete($this->table),
            new Where($this->wheres)
        ];
    }
}
