<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Set;

/**
 * SettableInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Statement\Builder\SQL\Set
 */
interface SettableInterface
{
    /**
     * @param $column
     * @param $value
     * @return $this
    */
    public function set($column, $value): static;
}
