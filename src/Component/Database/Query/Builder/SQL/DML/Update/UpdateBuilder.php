<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Update;

use Laventure\Component\Database\Query\Builder\SQL\Commands\Set;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Update;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Where;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;

/**
 * UpdateBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\PgsqlUpdateBuilder
*/
class UpdateBuilder extends SQLBuilder implements UpdateBuilderInterface
{
    /**
     * @inheritDoc
    */
    public function update(string $table): static
    {
        $this->criteria->table = $table;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getCommands(): array
    {
        return [
            new Update($this->criteria->table),
            new Set($this->criteria->set),
            new Where($this->criteria->wheres)
        ];
    }
}
