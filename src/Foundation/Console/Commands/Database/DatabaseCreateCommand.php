<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Database;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * DatabaseCreateCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Database
*/
class DatabaseCreateCommand extends Command
{
    /**
     * @var string
    */
    protected $name = 'database:create';




    /**
     * @var array
    */
    protected array $description = [
        "Creates the configured database"
    ];




    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        return Command::SUCCESS;
    }





    /**
     * @return string[]
    */
    public function getUsage(): array
    {
        return ["$this->name [options]"];
    }
}
