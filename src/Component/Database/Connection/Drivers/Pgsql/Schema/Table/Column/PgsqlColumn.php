<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Pgsql\Schema\Table\Column;

use Laventure\Component\Database\Schema\Column\Column;

/**
 * PgsqlColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\Pgsql
 */
class PgsqlColumn extends Column
{
    /**
     * @inheritDoc
     */
    public function increment(): static
    {
        // TODO: Implement increment() method.
    }

    /**
     * @inheritDoc
     */
    public function modify(): static
    {
        // TODO: Implement modify() method.
    }
}
