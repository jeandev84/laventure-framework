<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Server;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * ServerStartCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Server
*/
class ServerStartCommand extends Command
{
    /**
     * @var string
    */
    protected $name = 'server:start';


    /**
     * @var array|string[]
    */
    protected array $description = [
        'This command permit to [START] internal server of application.'
    ];





    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->success("Server starting ...");

        return Command::SUCCESS;
    }





    /**
     * @return string[]
    */
    public function getUsage(): array
    {
        return ["{$this->getName()} [options]"];
    }
}
