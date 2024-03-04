<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Delete;

use Laventure\Component\Database\Connection\Query\Builder\SQL\Conditions\Where\WhereInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\SQLBuilderInterface;

/**
 * DeleteWhereBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Delete
 */
interface DeleteBuilderInterface extends SQLBuilderInterface, WhereInterface
{
    /**
     * @param string $table
     * @return $this
    */
    public function delete(string $table): static;
}
