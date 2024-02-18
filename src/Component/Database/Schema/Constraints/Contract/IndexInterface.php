<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Contract;

use Laventure\Component\Database\Schema\Column\Contract\HasColumnInterface;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;

/**
 * IndexInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Contract
*/
interface IndexInterface extends HasColumnInterface, ConstraintInterface
{
}
