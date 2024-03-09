<?php
declare(strict_types=1);

namespace Laventure\Component\Console\Command\Usage;


use Laventure\Component\Console\Command\Contract\CommandInterface;

/**
 * UsageCommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Usage
*/
interface UsageCommandInterface extends CommandInterface
{
      /**
       * @return mixed
      */
      public function getUsage(): mixed;
}