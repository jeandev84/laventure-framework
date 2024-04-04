<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Exceptions;

use Laventure\Exceptions\BaseException;

/**
 * NotFoundMappedClass
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data\Exception
*/
class NotFoundMappedClass extends BaseException
{
    public function __construct(string $message = "", array $data = [])
    {
        parent::__construct($message, $data, 404);
    }
}
