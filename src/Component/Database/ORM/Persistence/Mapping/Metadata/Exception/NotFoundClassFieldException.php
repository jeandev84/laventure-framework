<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Exception;

use Laventure\Exceptions\BaseException;
use Throwable;

/**
 * NotFoundClassFieldException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\DataMapper\Mapping\Metadata\Exception
 */
class NotFoundClassFieldException extends BaseException
{
    /**
     * @param string $field
     * @param array $data
    */
    public function __construct(string $field, array $data = [])
    {
        parent::__construct("Not found field $field", $data, 404);
    }
}
