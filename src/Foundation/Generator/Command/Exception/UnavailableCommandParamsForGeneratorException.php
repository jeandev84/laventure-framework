<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Command\Exception;

use Throwable;

/**
 * UnavailableCommandParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Command\Exception
 */
class UnavailableCommandParamsForGeneratorException extends CommandGeneratorException
{
      public function __construct(string $classGenerator, array $data = [])
      {
          parent::__construct("Unavailable command params for generator. ($classGenerator)", $data, 409);
      }
}