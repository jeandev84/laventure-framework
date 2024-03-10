<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Defaults\List;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;
use Laventure\Component\Console\Command\Contract\OptionCommandInterface;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Component\Console\Output\Table\ConsoleTable;

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
     * @var array
    */
    protected array $usage = [
        'command [options] [arguments]'
    ];





    /**
     * @var array
    */
    protected array $optionList = [
        "-h, --help               Display help for the given command. When no command is given display help for the (list) command",
        '-q, --quiet              Do not output any message',
        '-V, --version            Display this application version',
        '    --ansi|--no-ansi     Force (or disable --no-ansi) ANSI output',
        '-n, --no-interaction     Do not ask any interactive question',
        '-e, --env=ENV            The Environment name. [default: "dev"]',
        '    --no-debug           Switch off debug mode.',
        '-v|vv|vvv, --verbose     Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug'
    ];




    /**
     * @var array
    */
    protected array $optionLength = [];




    /**
     * @var array
    */
    protected array $availableCommandList = [];





    public function __construct($name = null)
    {
        parent::__construct($name);
    }




    protected function configure(): void
    {
        $this->optionList(
            "--help",
            "Display help for the given command. When no command is given display help for the ($this->name) command",
            "-h"
        )->optionList("--quiet", "Do not output any message", '-q')
         ->optionList('--version', 'Display this application version', '-V')
         ->optionList('--ansi|--no-ansi', 'Force (or disable --no-ansi) ANSI output')
         ->optionList('--no-interaction', 'Do not ask any interactive question', '-n')
         ->optionList('--env=ENV', 'The Environment name. [default: "dev"]', '-e')
         ->optionList('--no-debug', "Switch off debug mode.")
         ->optionList(
             '-v|vv|vvv',
             "Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug",
             '--verbose'
         );
    }





    /**
     * @inheritDoc
    */
    public function withUsage($usage): static
    {
        $this->usage[] = $usage;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withUsages(array $usages): static
    {
        $this->usage = array_merge($this->usage, $usages);

        return $this;
    }




    /**
     * @param $longOption
     * @param $description
     * @param $shortcutOption
     * @return $this
    */
    public function optionList($longOption, $description, $shortcutOption = null): static
    {
        $command = $shortcutOption ? "$shortcutOption, $longOption" : "   $longOption";

        $this->optionList[$command] = $description;

        $this->optionLength[] = mb_strlen($command);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function withOption(OptionCommandInterface $command): static
    {
        $shortcutOption = $command->getShortcutOption();
        $longOption     = $command->getLongOption();
        $description    = $command->descriptionAsString();

        return $this->optionList($longOption, $description, $shortcutOption);
    }






    /**
     * @inheritDoc
    */
    public function withOptions(array $options): static
    {
        foreach ($options as $option) {
            $this->withOption($option);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function withAvailableCommand(CommandInterface $command): static
    {
        $this->availableCommandList[] = $command;

        return $this;
    }




    /**
     * @@inheritDoc
    */
    public function withAvailableCommands(array $commands): static
    {
        foreach ($commands as $command) {
            $this->withAvailableCommand($command);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function list(): array
    {
        return [
           'Usage'              => $this->usage,
           'Options'            => $this->optionList,
           'Available commands' => $this->availableCommandList
        ];
    }




    /**
     * @return int
     */
    public function getMaxlengthOfIndex(): int
    {
        return max($this->optionLength);
    }




    /**
     * @return array
     */
    public function getOptionLength(): array
    {
        return $this->optionLength;
    }



    private function toReviews(): void
    {
        /*
        dump($this->getMaxlengthOfIndex());

        foreach ($this->list() as $header => $expressions) {
            $output->writeln("$header:");
            foreach ($expressions as $index => $expression) {
                $message  = $expression;
                $space = '';
                for ($i = 0; $i <= $this->getMaxlengthOfIndex(); $i++) {
                    $space .= ' ';
                }
                $space = '                   ';
                #$lengthIndex = strlen($index);
                #$lengthExpr  = strlen($expression);
                #$space = str_repeat(' ', $this->getMaxlengthOfIndex());

                if ($index) {
                    #$message = "$index$space$expression";
                    #$message = "$index". substr($expression, $position, strlen($expression) + $position);
                    #$message  = "$index $expression";
                    $message  = "$index$space$expression";
                }

                $output->writeln("  $message");
            }
            $output->writeln('');
        }
        */

    }





    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        /*
        $table = new ConsoleTable();

        $table->addRow(['-h, --help', 'Display help for the given command. When no command is given display help for the (list) command'])
              ->addRow(['-q, --quiet', 'Do not output any message'])
              ->addRow(['-V, --version', 'Display this application version'])
              ->hideBorder()
              ->display();
        */

        foreach ($this->listHeaders as $header => $expressions) {
            $output->writeln("$header:");
            foreach ($expressions as $expression) {
                $output->writeln("  $expression");
            }
            $output->writeln('');
        }
        return Command::SUCCESS;
    }
}
