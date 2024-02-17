<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Delete;

use Laventure\Component\Database\Builder\SQL\Conditions\SQlBuilderConditionTrait;
use Laventure\Component\Database\Builder\SQL\Expr\Where;
use Laventure\Component\Database\Builder\SQL\Expr\Delete;
use Laventure\Component\Database\Builder\SQL\Formatter\SQlFormatter;

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
    use SQlBuilderConditionTrait;

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
    public function getSQL(): string
    {
        return (new SQlFormatter())->addFormats([
            new Delete($this->table),
            new Where($this->wheres)
        ])->format();
    }
}
