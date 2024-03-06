<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Set;


/**
 * SettableResolverInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Query\Builder\SQL\Set
*/
interface SettableResolverInterface
{

    /**
     * @param $column
     * @param $value
     * @return string
    */
    public function resolveSet($column, $value): string;
}