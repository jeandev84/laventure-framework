<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Exception;

/**
 * NotFoundClassNameException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Exception
 */
class NotFoundClassNameException extends ActiveRecordException
{
    public function __construct(string $model, array $data = [])
    {
        parent::__construct("empty class name from ($model)", $data, 409);
    }
}
