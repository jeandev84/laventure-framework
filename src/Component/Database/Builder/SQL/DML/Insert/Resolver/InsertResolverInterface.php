<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Insert\Resolver;

use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertSQlBuilderInterface;

/**
 * InsertResolverInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Insert\Resolver
 */
interface InsertResolverInterface
{
    /**
     * @param array $attributes
     *
     * @return InsertSQlBuilderInterface
    */
    public function resolve(array $attributes): InsertSQlBuilderInterface;
}
