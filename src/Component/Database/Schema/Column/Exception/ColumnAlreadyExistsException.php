<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Exception;

use Throwable;

/**
 * ColumnAlreadyExistsException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Exception
*/
class ColumnAlreadyExistsException extends ColumnException
{
    public function __construct(string $column, array $data = [])
    {
        parent::__construct("Column '$column' already exist", $data, 409);
    }
}
