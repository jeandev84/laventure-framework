<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Conditions\Resolver;

/**
 * ConditionResolved
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions\Resolver
 */
class ConditionResolved
{
    public array $wheres     = [];
    public array $parameters = [];
}
