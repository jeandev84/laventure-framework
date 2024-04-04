<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Exception;

use Laventure\Exceptions\BaseException;

/**
 * NotFoundColumnException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Exception
*/
class NotFoundColumnException extends BaseException
{
    /**
     * @param string $column
     * @param array $data
    */
    public function __construct(string $column, array $data = [])
    {
        parent::__construct("Column '$column' not found.", $data, 404);
    }
}
