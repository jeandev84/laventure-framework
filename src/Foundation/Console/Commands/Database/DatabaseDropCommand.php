<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Database;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * DatabaseDropCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Database
 */
class DatabaseDropCommand extends Command
{
    /**
     * @var string
    */
    protected $name = 'database:drop';




    /**
     * @var array
    */
    protected array $description = [
        "Drop the configured database"
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
