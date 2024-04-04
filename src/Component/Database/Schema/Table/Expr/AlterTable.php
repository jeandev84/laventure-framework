<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Expr;

use Laventure\Component\Database\Query\Builder\SQL\Contract\SQLInterface;
use Stringable;

/**
 * AlterTable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Expr
*/
class AlterTable implements SQLInterface
{
    /**
     * @param string $table
     * @param string $criteria
    */
    public function __construct(
        protected string $table,
        protected string $criteria
    ) {
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->getSQL();
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return sprintf('ALTER TABLE %s %s', $this->table, $this->criteria);
    }
}
