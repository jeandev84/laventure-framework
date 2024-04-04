<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\Where\WhereInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;

/**
 * SQLBuilderHasConditionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Conditions
*/
interface SQLBuilderHasConditionInterface extends SQLBuilderInterface, WhereInterface
{
}
