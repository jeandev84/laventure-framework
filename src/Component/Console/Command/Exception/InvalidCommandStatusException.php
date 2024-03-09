<?php
declare(strict_types=1);

namespace Laventure\Component\Console\Command\Exception;

use Laventure\Exceptions\BaseException;
use Throwable;

/**
 * InvalidCommandStatusException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Exception
*/
class InvalidCommandStatusException extends BaseException
{
      /**
       * @param int $status
       * @param string $method
       * @param array $statuses
       * @param array $data
      */
      public function __construct(int $status, string $method, array $statuses, array $data = [])
      {
          $lookFor = join(', ', $statuses);

          parent::__construct("Unavailable status ($status) from ($method). Use next ($lookFor)", $data, 409);
      }
}