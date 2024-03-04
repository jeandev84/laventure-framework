<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Set\PDO;

use Laventure\Component\Database\Connection\Query\Builder\SQL\Set\SettableResolver;

/**
 * SettableResolverPDO
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Query\Builder\SQL\Set\PDO
*/
class SettableResolverPDO extends SettableResolver
{
    /**
     * @inheritDoc
    */
    public function resolve($column, $value): string
    {
        $set = parent::resolve($column, ":$column");
        $this->builder->setParameter($column, $value);
        return $set;
    }
}