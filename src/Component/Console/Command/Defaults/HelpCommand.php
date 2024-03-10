<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Defaults;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\HelpCommandInterface;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * HelpCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Defaults
*/
class HelpCommand extends Command implements HelpCommandInterface
{
    public function __construct()
    {
        parent::__construct('help');
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
    public function getShortcutOption(): string
    {
        return '-h';
    }



    /**
     * @inheritDoc
    */
    public function getLongOption(): string
    {
        return '--help';
    }
}
