<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Set;

use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;

/**
 * SettableResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Query\Builder\SQL\Set
*/
class SettableResolver implements SettableResolverInterface
{
    /**
     * @param SQLBuilderInterface $builder
    */
    public function __construct(protected SQLBuilderInterface $builder)
    {
    }



    /**
     * @inheritDoc
    */
    public function eq($column, $value): string
    {
        return strval($this->builder->expr()->eq($column, $value));
    }
}
