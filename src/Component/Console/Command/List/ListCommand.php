<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\List;

use Laventure\Component\Console\Command\Collection\CommandCollectionInterface;
use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * ListCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Defaults
*/
class ListCommand extends Command implements ListCommandInterface
{


    /**
     * @var string
    */
    protected $name = 'list';




    /**
     * @var array
    */
    private array $listHeaders = [
        'Usage' => [
            'command [options] [arguments]'
        ],
        'Options' => [
            "-h, --help               Display help for the given command. When no command is given display help for the (list) command",
            '-q, --quiet              Do not output any message',
            '-V, --version            Display this application version',
            '    --ansi|--no-ansi     Force (or disable --no-ansi) ANSI output',
            '-n, --no-interaction     Do not ask any interactive question',
            '-e, --env=ENV            The Environment name. [default: "dev"]',
            '    --no-debug           Switch off debug mode.',
            '-v|vv|vvv, --verbose     Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug'
        ]
    ];





    /**
     * @param CommandCollectionInterface $collection
    */
    public function __construct(protected CommandCollectionInterface $collection)
    {
         parent::__construct();
    }







    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
         foreach ($this->listHeaders as $header => $expressions) {
             $output->writeln("$header:");
             foreach ($expressions as $expression) {
                 $output->writeln("  $expression");
             }
             $output->writeln('');
         }

         $availableCommands = $this->collection->getAvailableCommands();

         if (!empty($availableCommands)) {
             $output->writeln("Available commands:");
             foreach ($availableCommands as $command) {
                  if ($command->hasNameSeparated()) {
                      $name = $command->getFirstNameSeparated();
                      $output->writeln($name);
                      $output->writeln("  {$command->getName()}  {$command->getDescriptionAsString()}");
                  } else {
                      $output->writeln("  {$command->getName()}  {$command->getDescriptionAsString()}");
                  }

             }
         }

         return Command::SUCCESS;
    }

    
    
    
    /**
     * @inheritDoc
    */
    public function getCollection(): CommandCollectionInterface
    {
        return $this->collection;
    }
}
