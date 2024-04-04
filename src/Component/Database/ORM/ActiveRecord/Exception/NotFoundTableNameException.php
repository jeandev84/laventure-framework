<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Exception;

use Throwable;

/**
 * NotFoundTableNameException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Exception
*/
class NotFoundTableNameException extends ActiveRecordException
{
    public function __construct(string $classname, array $data = [])
    {
        parent::__construct("empty table name in class ($classname)", $data, 409);
    }
}
