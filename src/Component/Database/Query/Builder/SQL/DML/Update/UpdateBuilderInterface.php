<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Update;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\Where\WhereInterface;
use Laventure\Component\Database\Query\Builder\SQL\Set\SettableInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;

/**
 * UpdateBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Update
*/
interface UpdateBuilderInterface extends SQLBuilderInterface, WhereInterface, SettableInterface
{
    /**
     * @param string $table
     * @return $this
    */
    public function update(string $table): static;
}
