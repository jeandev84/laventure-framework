<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions;

/**
 * ConditionType
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Conditions
*/
enum ConditionType
{
    public const DEFAULT = 'conditions';
    public const AND     = 'AND';
    public const OR      = 'OR';
}
