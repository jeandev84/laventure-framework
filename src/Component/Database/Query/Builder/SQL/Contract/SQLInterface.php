<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Contract;

use Stringable;

/**
 * HasSQLInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Contract
*/
interface SQLInterface extends Stringable
{
    /**
     * @return string
    */
    public function getSQL(): string;
}
