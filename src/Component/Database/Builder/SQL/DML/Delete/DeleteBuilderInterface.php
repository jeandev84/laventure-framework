<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Delete;


use Laventure\Component\Database\Builder\SQL\Conditions\Contract\BuilderConditionInterface;

/**
 * DeleteBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Delete
 */
interface DeleteBuilderInterface extends BuilderConditionInterface
{
    /**
     * @param string $table
     * @param string $alias
     * @return $this
    */
    public function delete(string $table, string $alias = ''): static;
}