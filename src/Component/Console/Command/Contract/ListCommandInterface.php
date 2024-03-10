<?php
declare(strict_types=1);

namespace Laventure\Component\Console\Command\Contract;


use Laventure\Contract\Lister\ListenableInterface;


/**
 * ListCommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Contract
*/
interface ListCommandInterface extends CommandInterface, ListenableInterface
{


      /**
       * @param $usage
       * @return $this
      */
      public function withUsage($usage): static;






      /**
       * @param array $usages
       * @return $this
      */
      public function withUsages(array $usages): static;







      /**
       * @param OptionCommandInterface $command
       * @return $this
      */
      public function withOption(OptionCommandInterface $command): static;








      /**
       * @param OptionCommandInterface[] $options
       * @return $this
      */
      public function withOptions(array $options): static;









      /**
       * @param CommandInterface $command
      */
      public function withAvailableCommand(CommandInterface $command): static;







      /**
       * @param array $commands
       * @return $this
      */
      public function withAvailableCommands(array $commands): static;
}
