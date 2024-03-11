<?php
declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Command;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\Argument\InputArgument;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * MakeCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Command
*/
class MakeCommand extends Command
{

    /**
     * @var string
    */
    protected $name = 'app:make:command';


    /**
     * @var array|string[]
    */
    protected array $description = [
        'Permit to create a new command.'
    ];



    public function __construct()
    {
        parent::__construct($this->name);
    }





    /**
     * @inheritDoc
    */
    protected function configure(): void
    {
        $this->addArgument('name', "Choose a command name (e.g. app:foo-command)")
             ->required();
    }





    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
         return Command::SUCCESS;
    }





    /**
     * @inheritDoc
    */
    public function getUsage(): array
    {
        return [
           "{$this->getName()} [<name>]"
        ];
    }
}