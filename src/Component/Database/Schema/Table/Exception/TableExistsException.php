<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Exception;

use Throwable;

/**
 * TableExistsException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Exceptions
 */
class TableExistsException extends TableException
{
    public function __construct(string $table, array $data = [])
    {
        parent::__construct("Table '$table' already exists.", $data, 409);
    }
}
