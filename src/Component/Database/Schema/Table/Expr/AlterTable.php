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
     * @param array $criteria
    */
    public function __construct(
        protected string $table,
        protected array $criteria = []
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
        $alter[] = sprintf('ALTER TABLE %s', $this->table);

        if ($this->criteria) {
            $alter[] = join(PHP_EOL, $this->criteria);
        }

        return join(PHP_EOL, $alter);
    }
}
