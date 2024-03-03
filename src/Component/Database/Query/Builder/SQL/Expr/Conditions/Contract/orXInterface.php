<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions\Contract;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\HasConditionInterface;
use Stringable;

/**
 * orXInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr\Conditions\Contract
*/
interface orXInterface extends HasConditionInterface, Stringable
{
}
