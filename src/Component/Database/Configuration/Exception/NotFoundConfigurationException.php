<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Configuration\Exception;

use Laventure\Exceptions\BaseException;
use Throwable;

/**
 * NotFoundConfigurationException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Configuration\Exception
*/
class NotFoundConfigurationException extends BaseException
{
    /**
     * @param array $data
     * @param Throwable|null $previous
    */
    public function __construct(array $data = [], ?Throwable $previous = null)
    {
        parent::__construct("Not found credentials", $data, 404, $previous);
    }
}
