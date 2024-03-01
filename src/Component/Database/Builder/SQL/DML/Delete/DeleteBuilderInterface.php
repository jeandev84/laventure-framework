<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Delete;

use Laventure\Component\Database\Builder\SQL\Conditions\Contract\WhereBuilderInterface;
use Laventure\Component\Database\Builder\SQL\SqlBuilderInterface;

/**
 * DeleteWhereBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Delete
 */
interface DeleteBuilderInterface extends SqlBuilderInterface, WhereBuilderInterface
{
    /**
     * @param string $table
     * @return $this
    */
    public function delete(string $table): static;
}
