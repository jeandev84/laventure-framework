<?php

declare(strict_types=1);

namespace Laventure\Contract\Resolver;

/**
 * ResolverInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Resolver
 */
interface ResolverInterface
{
    /**
     * Resolve something
     * @return mixed
    */
    public function resolve(): mixed;
}
