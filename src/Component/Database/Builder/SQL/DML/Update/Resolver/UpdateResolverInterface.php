<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DML\Update\Resolver;

use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;

/**
 * UpdateResolverInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Update\Resolver
 */
interface UpdateResolverInterface
{
    /**
     * @param array $attributes
     * @return UpdateBuilderInterface
    */
    public function resolve(array $attributes): UpdateBuilderInterface;
}
