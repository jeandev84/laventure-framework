<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Delete;

use Laventure\Component\Database\Builder\SQL\Conditions\SQlBuilderConditionTrait;
use Laventure\Component\Database\Builder\SQL\Expr\Where;
use Laventure\Component\Database\Builder\SQL\Expr\Delete;

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


    /**
     * @inheritDoc
    */
    public function delete(string $table, string $alias = ''): static
    {
        $this->criteria->table($table, $alias);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->formatter->addFormats([
            new Delete($this->criteria->table),
            new Where($this->criteria->wheres)
        ])->format();
    }
}
