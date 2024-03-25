<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Exception;

use Laventure\Exceptions\BaseException;
use Throwable;

/**
 * NotFoundTableException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Exception
 */
class NotFoundTableException extends TableException
{
    /**
     * @param string $tableName
     * @param array $data
    */
    public function __construct(string $tableName, array $data = [])
    {
        parent::__construct("Table $tableName does not exist.", $data, 404);
    }
}
