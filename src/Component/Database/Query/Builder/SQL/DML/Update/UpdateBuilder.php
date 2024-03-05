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
 * @package  Laventure\Component\Database\Builder\SQL\DML\Update
*/
class UpdateBuilder extends SQLBuilder implements UpdateBuilderInterface
{

    #use WhereTrait;

    /**
     * @var string|null
    */
    public ?string $table = null;





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
    public function getCommands(): array
    {
        return [
            new Update($this->table),
            new Set($this->set),
            new Where($this->wheres)
        ];
    }
}
