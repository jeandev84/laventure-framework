<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Delete;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\SQLBuilderHasConditionInterface;

/**
 * DeleteWhereBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\MysqlDeleteBuilder
*/
interface DeleteBuilderInterface extends SQLBuilderHasConditionInterface
{
    /**
     * @param string $table
     * @return $this
    */
    public function delete(string $table): static;
}
