<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Expr\Conditions\Contract;

use Laventure\Component\Database\Connection\Query\Builder\SQL\Conditions\HasConditionInterface;
use Stringable;

/**
 * andXInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr\Conditions\Contract;
 */
interface andXInterface extends HasConditionInterface, Stringable
{
}
