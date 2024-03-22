<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Exception;

use Throwable;

/**
 * UnavailableDatabaseNameException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Exception
*/
class UnavailableDatabaseNameException extends DatabaseException
{
    /**
     * @param string $classname
     * @param array $data
    */
    public function __construct(string $classname, array $data = [])
    {
        parent::__construct("Database name is not specified for $classname", $data, 409);
    }
}
